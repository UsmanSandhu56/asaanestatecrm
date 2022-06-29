<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\User;
use App\Models\Agency;
use App\Models\Scraper;
use Livewire\Component;
use App\Jobs\ScraperJob;
use Livewire\WithFileUploads;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Artisan;

class Profile extends Component
{
    use WithFileUploads;

    public $agency, $agency_name,$zameen_url, $agency_email, $agency_address, $agency_phone_no, $name, $email, $phone_no, $profile, $current_password, $new_password, $password_confirmation, $commission,$scraper;

    public function mount()
    {

        $this->agency = Agency::findOrFail(session('agency_id'));
        $this->agency_id = $this->agency->id;
        $this->agency_name = $this->agency->name;
        $this->agency_email = $this->agency->email;
        $this->zameen_url = $this->agency->zameen_url;
        $this->agency_phone_no = $this->agency->phone_no;
        $this->agency_address = $this->agency->address;
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone_no = auth()->user()->phone_no;
        $this->commission = auth()->user()->agencies()->first()->pivot->commission;
        $this->scraper = Scraper::where('agency_id',$this->agency->id)->orderBy('id', 'DESC')->first();
        if($this->scraper)
        {
        $this->status =$this->scraper->status;
        }
        else
        {
        $this->status = null;
        }


    }
    public function confirmPropertyRemoval()
    {
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function render()
    {
        return view('livewire.admin.profile.profile');


    }

    public function updateAgencyProfile()
    {
        $this->validate();
        $this->agency->update(['name' => $this->agency_name, 'email' => $this->agency_email,'zameen_url'=>$this->zameen_url, 'phone_no' => $this->agency_phone_no, 'address' => $this->agency_address]);
        if (isset($this->profile)) {
            if ($this->agency->getFirstMedia('profile')) {
                $this->agency->getFirstMedia('profile')->delete();
            }
            $this->agency->addMedia($this->profile->getRealPath())->toMediaCollection('profile');
            unset($this->profile);
            $this->mount();
        }
        return redirect()->route('profile')->with('success', 'Agency Profile updated successfully!');
    }

    public function InsertScraper()
    {
        if($this->zameen_url)
        {
        $addscraper =new Scraper;
        $addscraper->user_id = auth()->user()->id;
        $addscraper->agency_id = $this->agency_id;
        $addscraper->zameen_url = $this->zameen_url;
        $addscraper->status = 0;

        $addscraper->save();

       $scraper_id =  $addscraper->id;
     ScraperJob::dispatch($this->agency_id,$scraper_id)->beforeCommit();


        return redirect()->route('profile')->with('success', 'Scraper Added successfully');

        }
        else
        {
        return redirect()->route('profile')->with('error', 'Enter Agency url first');
        }



    }

    public function updateProfile()
    {


        $this->validate([
            'name' => ['required', 'max:50'],
            'email' => ['nullable', 'email', 'max:50', Rule::unique('agencies')->ignore($this->agency)],
            'phone_no' => ['required', 'starts_with:03', Rule::unique('users')->ignore(auth()->user()), 'min:11', 'max:11'],
            'commission' => ['required'],
        ]);
        auth()->user()->update(['name' => $this->name, 'email' => $this->email, 'phone_no' => $this->phone_no]);
        auth()->user()->agencies()->syncWithPivotValues(session('agency_id'), ['commission' => $this->commission]);
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'same:password_confirmation', Rules\Password::defaults()]
        ]);
        User::findOrFail(auth()->user()->id)->update(['password' => Hash::make($this->new_password)]);
        return redirect()->route('profile')->with('success', 'Password changed updated successfully!');
    }

    protected function rules()
    {
        return [
            'agency_name' => ['required', 'max:50'],
            'agency_email' => ['required', 'email', 'max:50', Rule::unique('agencies', 'email')->ignore($this->agency)],
            'agency_address' => ['required'],
            'agency_phone_no' => ['required', Rule::unique('agencies', 'phone_no')->ignore($this->agency), 'min:11', 'max:11'],
        ];
    }
}
