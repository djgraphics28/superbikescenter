<?php

namespace App\Filament\Resources\InquiryResource\Pages;

use Filament\Actions;
use App\Models\Product;
use App\Mail\InquiryResponse;
use Illuminate\Support\Facades\Mail;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\InquiryResource;

class CreateInquiry extends CreateRecord
{
    protected static string $resource = InquiryResource::class;

    // protected function afterCreate(): void
    // {
    //     parent::afterCreate();

    //     // Send the email with the form data
    //     Mail::to($this->record->email)->send(new InquiryResponse($this->record->toArray()));
    // }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $dataArray = $data;

        $product = Product::find($data['product_id']);

        $dataArray['motorcycle'] = $product->name;
        $dataArray['model'] = $product->model;
        // Send the email with the form data
        Mail::to($data['email'])->send(new InquiryResponse($dataArray));

        return $data;
    }
}
