<x-mail::message>
# Loan Application Submitted Successfully

Dear {{ $data['name'] }},

Thank you for applying for a Motorcycle Loan with us. Your application has been successfully received and is now under review. Below are the details you provided:

- **Loan Amount**: {{ $data['loanAmount'] }}
- **Number of Months to Pay**: {{ $data['monthsToPay'] }}
- **Monthly Payment Amount**: {{ $data['monthlyPaymentAmount'] }}
- **Downpayment**: {{ $data['downpayment'] }}

We will review your application and get back to you shortly with the status.

<x-mail::button :url="$data['url']">
Track Application Status
</x-mail::button>

If you have any questions or need further assistance, please feel free to contact us.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
