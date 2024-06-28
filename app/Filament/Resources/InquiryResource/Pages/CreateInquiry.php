<?php

namespace App\Filament\Resources\InquiryResource\Pages;

use Filament\Actions;
use App\Models\Product;
use App\Mail\InquiryResponse;
use App\Jobs\InquiryResponseJob;
use Illuminate\Support\Facades\Mail;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\InquiryResource;

class CreateInquiry extends CreateRecord
{
    protected static string $resource = InquiryResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $dataArray = $data;

        $product = Product::find($data['product_id']);

        $dataArray['motorcycle'] = $product->name;
        $dataArray['model'] = $product->model;
        // Send the response email to job
        InquiryResponseJob::dispatch($dataArray);

        return $data;
    }
}
