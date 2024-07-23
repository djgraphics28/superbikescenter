<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Application;

class ApplicationStatus extends Component
{
    public $forReview = false;
    public $inProgress = false;
    public $approved = false;
    public $released = false;
    public $application;
    public $loan_amount = 0;
    public $term = 0;
    public $interest_rate = 0;
    public $monthly_payment = 0;

    public function mount()
    {
        $customer = Customer::where('user_id', auth()->user()->id)->first();

        $application = Application::where('customer_id', $customer->id)->first();

        if (!$application) {
            return;
        } else {

            if ($application->status == 'for-review') {
                $this->forReview = true;
                $this->inProgress = false;
                $this->approved = false;
                $this->released = false;
            } elseif ($application->status == 'in-progress') {
                $this->forReview = true;
                $this->inProgress = true;
                $this->approved = false;
                $this->released = false;
            } elseif ($application->status == 'approved') {
                $this->forReview = true;
                $this->inProgress = true;
                $this->approved = true;
                $this->released = false;
            } elseif ($application->status == 'released') {
                $this->forReview = true;
                $this->inProgress = true;
                $this->approved = true;
                $this->released = true;
            }

            $this->loan_amount = $application->loan_amount;
            $this->term = $application->months_to_pay;
            $this->interest_rate = 5;
            $this->monthly_payment = $application->monthly_payment_amount;
        }


    }

    public function render()
    {
        return view('livewire.profile.application-status');
    }


}
