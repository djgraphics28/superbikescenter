<x-mail::message>
# Congratulations!

We are pleased to inform you that your application has been approved.

## Details of Your Motorcycle Loan:

- **Motorcycle:** {{ $data['motorModel'] }}
- **Downpayment:** {{ $data['downpayment'] }}
- **Monthly Payment:** {{ $data['monthlyPayment'] }}
- **Loan Term:** {{ $data['loanTerm'] }} months
- **Due Date for Monthly Payments:** {{ $data['dueDay'] }} of the month

<x-mail::button :url="$data['link']">
View Loan Details
</x-mail::button>

Thank you for choosing us as your financing partner. If you have any questions or need further assistance, please do not hesitate to contact us.

Best regards,<br>
{{ config('app.name') }}
</x-mail::message>
