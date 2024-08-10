<?php

namespace App\Filament\Resources;

use App\Mail\LoanApplicationApprovedResponseMail;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\MonthlyDue;
use Filament\Tables\Table;
use App\Models\Application;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ApplicationResource\Pages;
use App\Filament\Resources\ApplicationResource\RelationManagers;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    /**
     * Get the navigation badge for the resource.
     */
    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('product_id')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'id')
                    ->required(),
                Forms\Components\TextInput::make('source_of_income')
                    ->required(),
                Forms\Components\TextInput::make('name_of_business')
                    ->maxLength(255),
                Forms\Components\TextInput::make('company_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('work_position')
                    ->maxLength(255),
                Forms\Components\TextInput::make('years_in_work')
                    ->numeric(),
                Forms\Components\TextInput::make('monthly_income')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('comaker_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('comaker_work')
                    ->maxLength(255),
                Forms\Components\TextInput::make('comaker_monthly_income')
                    ->numeric(),
                Forms\Components\TextInput::make('agent_id')
                    ->numeric(),
                Forms\Components\TextInput::make('approved_by')
                    ->numeric(),
                Forms\Components\TextInput::make('cancelled_by')
                    ->numeric(),
                Forms\Components\TextInput::make('denied_by')
                    ->numeric(),
                Forms\Components\DatePicker::make('date_inquired')
                    ->required(),
                Forms\Components\DatePicker::make('date_applied')
                    ->required(),
                Forms\Components\TextInput::make('months_to_pay')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('monthly_payment_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('loan_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('downpayment')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.first_name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('source_of_income'),
                Tables\Columns\TextColumn::make('name_of_business')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('work_position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('years_in_work')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('monthly_income')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('comaker_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comaker_work')
                    ->searchable(),
                Tables\Columns\TextColumn::make('comaker_monthly_income')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agent_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('approved_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cancelled_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('denied_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_inquired')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_applied')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('months_to_pay')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('monthly_payment_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('loan_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('downpayment')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('changeStatus')
                    ->label('Change Status')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->options([
                                'for-review' => 'For-Review',
                                'in-progress' => 'In-Progress',
                                'approved' => 'Approved',
                                'released' => 'Released',
                                'denied' => 'Denied',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update(['status' => $data['status']]);

                        // Prepare email data
                        $emailData = [
                            'email' => $record->email,
                            'name' => $record->name,
                            'status' => $data['status'],
                            // 'link' => route('register'),
                        ];

                        if ($data['status'] == "approved") {
                            // Send email
                            // InquiryApprovedResponseJob::dispatch($emailData);
                            // Mail::to($emailData['email'])->send(new InquiryApprovedResponse($emailData));
                        } else if ($data['status'] == "released") {

                        }



                        // Show success notification
                        // Filament::notify('success', 'Status changed and email sent successfully.');
                    }),
                Tables\Actions\Action::make('status')
                    ->label('Approve')
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        try {
                            // Update the record's status to 'Approved'
                            $record->update([
                                'status' => 'Approved',
                                'approved_by' => Auth::user()->id, // Set the ID of the authenticated user
                            ]);

                            $monthsToPay = $record->months_to_pay;
                            $dayOfMonth = \Carbon\Carbon::parse($record->date_applied)->day; // Extract the day from date_applied

                            for ($i = 0; $i < $monthsToPay; $i++) {
                                // Calculate the due date for each month
                                $dueDate = \Carbon\Carbon::parse($record->date_applied)
                                    ->addMonthsNoOverflow($i)
                                    ->day($dayOfMonth);

                                // Ensure the day is valid (e.g., not setting February 30th)
                                if ($dueDate->day != $dayOfMonth) {
                                    $dueDate = $dueDate->lastOfMonth();
                                }

                                MonthlyDue::updateOrCreate(
                                    [
                                        'application_id' => $record->id,
                                        'user_id' => $record->customer->user_id,
                                        'due_date' => $dueDate,
                                    ],
                                    [
                                        'monthly_payment' => $record->monthly_payment_amount,
                                        // 'status' => 'Pending',
                                    ]
                                );
                            }

                            $emailData = [
                                'monthlyPayment' => $record->monthly_payment_amount,
                                'downpayment' => $record->downpayment,
                                'loanAmount' => $record->loan_amount,
                                'dateApplied' => $record->date_applied,
                                'motorModel' => $record->product->name,
                                'loanTerm' => $record->months_to_pay,
                                'dueDay' => \Carbon\Carbon::parse($record->date_applied)->format('jS'), // Day number
                                'link' => route('profile'),
                            ];

                            // Generate and send the PDF
                            Mail::to($record->customer->user->email)->send(new LoanApplicationApprovedResponseMail($emailData));

                            Notification::make()
                                ->title('Loan Application Approved')
                                ->body('Selected application has been approved and emails have been sent successfully.')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            // Log or handle the error
                            Log::error('Failed to send approval email: ' . $e->getMessage());
                            // Display an error notification
                            Notification::make()
                                ->title('Loan Application Approval Failed')
                                ->body('Failed to send approval emails. Please try again.')
                                ->danger()
                                ->send();
                        }
                    }),
                Tables\Actions\Action::make('revert')
                    ->label('Revert')
                    ->color('danger')
                    ->icon('heroicon-o-receipt-refund')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        try {
                            // Update the record's status to 'Approved'
                            $record->update([
                                'status' => 'For-Review',
                                'approved_by' => null, // Set the ID of the authenticated user
                            ]);

                            MonthlyDue::where('application_id', $record->id)->delete();

                            Notification::make()
                                ->title('Loan Application has been reverted')
                                ->body('Selected application has been reverted.')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            // Log or handle the error
                            Log::error('Failed to send approval email: ' . $e->getMessage());
                            // Display an error notification
                            Notification::make()
                                ->title('Loan Application Revert Failed')
                                ->body('Failed to revert. Please try again.')
                                ->danger()
                                ->send();
                        }
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'view' => Pages\ViewApplication::route('/{record}'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}
