<?php


namespace App\Http\Traits;

use Illuminate\Support\Facades\Session;


trait StepTrait
{
    public $totalSteps, $currentStep;

    public function increaseStep()
    {
        $this->resetErrorBag();
        $this->validate();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseStep()
    {
        Session::put('back-id',Session::get('id'));
        Session::put('req-back-id',Session::get('propertyrequirementid'));


        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }
}
