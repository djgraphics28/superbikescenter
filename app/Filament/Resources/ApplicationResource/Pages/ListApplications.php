<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'pending' => Tab::make('For Review')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'for-review')),
            'in-progress' => Tab::make('In-Progress')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'in-progress')),
            'approved' => Tab::make('Approved')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'approved')),
            'rejected' => Tab::make('Released')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'released')),
            'denied' => Tab::make('Denied')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'denied')),
            'cancelled' => Tab::make('Cancelled')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'cancelled')),
        ];
    }
}
