<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Application;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Mail;
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
                            'link' => route('register'),
                        ];

                        if ($data['status'] == "approved") {
                            // Send email
                            // InquiryApprovedResponseJob::dispatch($emailData);
                            // Mail::to($emailData['email'])->send(new InquiryApprovedResponse($emailData));
                        } else if($data['status'] == "released") {

                        }



                        // Show success notification
                        // Filament::notify('success', 'Status changed and email sent successfully.');
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
