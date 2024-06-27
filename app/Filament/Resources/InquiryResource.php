<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Inquiry;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Yajra\Address\Entities\City;
use Tables\Forms\Components\Select;
use Illuminate\Support\Facades\Mail;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\Province;
use App\Mail\InquiryApprovedResponse;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\InquiryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InquiryResource\RelationManagers;

class InquiryResource extends Resource
{
    protected static ?string $model = Inquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

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
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('province_id')
                    ->label('Province')
                    ->options(Province::all()->pluck('name', 'province_id'))
                    ->reactive() // Makes it reactive to changes
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('city_id', null); // Reset the city selection when the province changes
                    }),

                Forms\Components\Select::make('city_id')
                    ->label('City')
                    ->options(function (callable $get) {
                        $provinceId = $get('province_id');
                        if (!$provinceId) {
                            return [];
                        }
                        return City::where('province_id', $provinceId)->pluck('name', 'city_id');
                    })
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('barangay_id', null); // Reset the city selection when the province changes
                    }),
                Forms\Components\Select::make('barangay_id')
                    ->label('Barangay')
                    ->options(function (callable $get) {
                        $cityId = $get('city_id');
                        if (!$cityId) {
                            return [];
                        }
                        return Barangay::where('city_id', $cityId)->pluck('name', 'id');
                    })
                    ->reactive()
                    ->required(),
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\RichEditor::make('message')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'in-progress' => 'In-Progress',
                        'rejected' => 'Rejected',
                    ]),
                // Forms\Components\DatePicker::make('approved_date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Inquired Motorcycle')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('province.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('barangay.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('approved_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('changeStatus')
                    ->label('Change Status')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->options([
                                'approved' => 'Approved',
                                'in-progress' => 'In-Progress',
                                'pending' => 'Pending',
                                'rejected' => 'Rejected',
                            ])
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update(['status' => $data['status']]);

                        // Prepare email data
                        $emailData = [
                            'name' => $record->name,
                            'status' => $data['status'],
                            'link' => config('app.url').'/customer/register',
                        ];

                        if ($data['status'] == "approved") {
                            // Send email
                            Mail::to($record->email)->send(new InquiryApprovedResponse($emailData));
                        }



                        // Show success notification
                        // Filament::notify('success', 'Status changed and email sent successfully.');
                    }),
                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListInquiries::route('/'),
            'create' => Pages\CreateInquiry::route('/create'),
            'edit' => Pages\EditInquiry::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
