<?php

namespace App\Livewire\Application;

use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationSuccessResponseMail;

class Index extends Component
{
    public $customer_id;
    public $name;
    public $email;
    public $phone;
    public $products = [];
    public $product;
    public $source_of_income;
    public $name_of_business;
    public $company_name;
    public $work_position;
    public $years_in_work;
    public $comaker_name;
    public $comaker_work;
    public $comaker_monthly_income;
    public $agent;
    public $months_to_pay = 36;
    public $monthly_payment_amount;
    public $monthly_income;
    public $downpayment;
    public $loan_amount;
    public $terms;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|numeric',
        'product' => 'required|string|max:255',
        'source_of_income' => 'required',
        'loan_amount' => 'required|numeric|min:1000',
        'downpayment' => 'required|numeric|min:1000',
        'monthly_income' => 'required|numeric|min:10000',
        'months_to_pay' => 'required',
        'monthly_payment_amount' => 'required',
        'terms' => 'accepted',
    ];

    public function submit()
    {
        $this->validate();

        $checkApplication = Application::where('customer_id', $this->customer_id)->whereIn('status', ['for-review', 'for-ci', 'approved', 'in-progress'])->first();

        if(!$checkApplication) {
            Application::create([
                'customer_id' => $this->customer_id,
                'product_id' => $this->product,
                'source_of_income' => $this->source_of_income,
                'name_of_business' => $this->name_of_business,
                'company_name' => $this->company_name,
                'work_position' => $this->work_position,
                'years_in_work' => $this->years_in_work,
                'comaker_name' => $this->comaker_name,
                'comaker_work' => $this->comaker_work,
                'comaker_monthly_income' => $this->comaker_monthly_income,
                // 'agent' => $this->agent,
                'months_to_pay' => $this->months_to_pay,
                'monthly_payment_amount' => $this->monthly_payment_amount,
                'monthly_income' => $this->monthly_income,
                'downpayment' => $this->downpayment,
                'loan_amount' => $this->loan_amount,
                'date_applied' => now(),
                'date_inquired' => now(),
            ]);

            $emailData = [
                'name' => $this->name,
                'loanAmount' => $this->loan_amount,
                'downpayment' => $this->downpayment,
                'monthlyPaymentAmount' => $this->monthly_payment_amount,
                'monthsToPay' => $this->months_to_pay,
                'url' => route('profile')
            ];

            Mail::to($this->email)->send(new ApplicationSuccessResponseMail($emailData));

            session()->flash('success', 'Application submitted successfully.');
        } else {
            session()->flash('error', 'You already have an active application.');
        }


        // try {
        //     DB::beginTransaction();

        //     Application::create([
        //         'customer_id' => $this->customer_id,
        //         'product_id' => $this->product,
        //         'source_of_income' => $this->source_of_income,
        //         'name_of_business' => $this->name_of_business,
        //         'company_name' => $this->company_name,
        //         'work_position' => $this->work_position,
        //         'years_in_work' => $this->years_in_work,
        //         'comaker_name' => $this->comaker_name,
        //         'comaker_work' => $this->comaker_work,
        //         'comaker_monthly_income' => $this->comaker_monthly_income,
        //         // 'agent' => $this->agent,
        //         'months_to_pay' => $this->months_to_pay,
        //         'monthly_payment_amount' => $this->monthly_payment_amount,
        //         'monthly_income' => $this->monthly_income,
        //         'downpayment' => $this->downpayment,
        //         'loan_amount' => $this->loan_amount,
        //         'date_applied' => now(),
        //         'date_inquired' => now(),
        //     ]);

        //     // Additional database operations can be performed here

        //     DB::commit();

        //     session()->flash('message', 'Application submitted successfully.');

        //     $emailData = [
        //         'name' => $this->name,
        //         'loanAmount' => $this->loan_amount,
        //         'downpayment' => $this->downpayment,
        //         'monthlyPaymentAmount' => $this->monthly_payment_amount,
        //         'monthsToPay' => $this->months_to_pay
        //     ];

        //     Mail::to($this->email)->send(new ApplicationSuccessResponseMail($emailData));

        //     $this->reset(); // Clear form fields

        //     return redirect()->route('profile');

        // } catch (\Exception $e) {

        //     DB::rollBack();
        //     // Log the error or handle it accordingly
        //     session()->flash('message', 'An error occurred while submitting the application. Please try again.');
        // }
    }

    public function render()
    {
        return view('livewire.application.index');
    }

    public function mount()
    {

        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;

        $this->customer_id = Customer::where('user_id', auth()->id())->first()->id;
        $this->phone = Customer::where('user_id', auth()->id())->first()->contact_number;

        $this->products = Product::all();
    }

    public function updatedProduct($value)
    {
        $motor = Product::find($value);

        $this->loan_amount = $motor->price;

        $this->calculateMonthlyPaymentAmount();
    }

    public function updatedDownpayment($value)
    {
        $this->downpayment = $value;

        $this->calculateMonthlyPaymentAmount();
    }

    private function calculateMonthlyPaymentAmount()
    {
        $motor = Product::find($this->product);

        if ($motor) {
            $price = $motor->price;

            $monthly_payment_amount = ($price - $this->downpayment) / $this->months_to_pay;

            // Round off to 2 decimal places
            $this->monthly_payment_amount = round($monthly_payment_amount, 2);
        }
    }
}
