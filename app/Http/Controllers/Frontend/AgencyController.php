<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agency\AgencyRequest;
use App\Http\Requests\Agency\ChangePasswordRequest;
use App\Models\Agency;
use App\Models\User;

class AgencyController extends Controller
{
    public function index()
    {
        $agencies = Agency::with(['users.roles' => function ($q) {
            $q->where('slug', 'owner')->first();
        }])->get();
        return view('frontend.agency.agency-login', compact('agencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->agencies()->exists()) {
            return view('frontend.agency.create');
        }
        return redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgencyRequest $request)
    {
        Agency::create($request->validated());
        //Using AgencyObserver and AgencyService for remaining code
        return redirect()->route('dashboard');
    }

    public function agencylogin(User $user)
    {
        auth()->login($user, true);
        return redirect()->route('dashboard');
    }

    public function activateOwner(User $user)
    {
        $status = !$user->is_active;
        $user->update(['is_active' => $status]);
        return back()->with('success', 'User status updated!');
    }

    public function changePassword(ChangePasswordRequest $request, User $user)
    {
        $user->update([
            'password' => bcrypt($request->new_password),
        ]);
        return back()->with('success', 'Password updated successfully!');
    }
}
