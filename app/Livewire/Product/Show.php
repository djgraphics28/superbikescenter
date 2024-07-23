<?php

namespace App\Livewire\Product;

use App\Models\Inquiry;
use App\Models\Product;
use Livewire\Component;
use App\Concerns\HasPreview;
use Spatie\SchemaOrg\Schema;
use App\Mail\InquiryResponse;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Illuminate\Support\Facades\Mail;
use Yajra\Address\Entities\Province;

class Show extends Component
{
    use HasPreview;

    /**
     * The product instance.
     *
     * @var \App\Models\Product
     */
    public $product;

    /**
     * Form fields for inquiry.
     *
     * @var array
     */
    public $name;
    public $email;
    public $contact_number;
    public $province;
    public $city;
    public $barangay;
    public $message;
    public $loading = false;


    /**
     * Whether to show the success message.
     *
     * @var bool
     */
    public $showSuccessMessage = false;

    /**
     * Mount the component.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function mount($product)
    {
        $this->product = Product::whereSlug($product)->firstOrFail();

        $this->handlePreview();

        abort_unless($this->isPreview || $this->product->created_at, 404);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        seo()
            ->title($this->product->name)
            ->description($this->product->excerpt)
            ->canonical($this->product->url)
            ->addSchema(
                Schema::article()
                    ->headline($this->product->name)
                    ->articleBody($this->product->excerpt)
                    ->image($this->product->image_url)
                    ->datePublished($this->product->created_at)
                    ->dateModified($this->product->updated_at)
            );

        if ($this->product->image) {
            seo()->image($this->product->image_url);
        }

        // Fetch provinces, cities, and barangays
        $provinces = Province::all();
        $cities = [];
        $barangays = [];

        if (!is_null($this->province)) {
            $cities = City::where('province_id', $this->province)->get();
        }

        if (!is_null($this->city)) {
            $barangays = Barangay::where('city_id', $this->city)->get();
        }

        return view('livewire.product.show', [
            'provinces' => $provinces,
            'cities' => $cities,
            'barangays' => $barangays,
        ]);
    }

    /**
     * Reset cities and barangays when province changes.
     */
    public function updatedProvince($value)
    {
        $this->city = null;
        $this->barangay = null;

        if (!is_null($value)) {
            $this->cities = City::where('province_id', $value)->get();
        } else {
            $this->cities = [];
        }
    }

    /**
     * Reset barangays when city changes.
     */
    public function updatedCity($value)
    {
        $this->barangay = null;

        if (!is_null($value)) {
            $this->barangays = Barangay::where('city_id', $value)->get();
        } else {
            $this->barangays = [];
        }
    }


    /**
     * Submit inquiry form.
     *
     * @return void
     */
    public function submitInquiry()
    {
        $this->loading = true;
        // Validate form fields
        $validatedData = $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'contact_number' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'message' => 'required|string',
        ]);

        $product = Product::find($this->product->id);

        if (!$product) {
            $this->loading = false;
            return response()->json(['message' => 'Product Not Found!'], 404);
        }

        // Prepare the data to be used for the email
        $data = [
            'motorcycle' => $product->name ?? null,
            'model' => $product->model,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
            'contact_number' => $validatedData['contact_number'] ?? null,
            'province_id' => $validatedData['province'] ?? null,
            'city_id' => $validatedData['city'] ?? null,
            'barangay' => $validatedData['barangay'] ?? null,
        ];

         // Prepare the data to be used for the inquiry
         $dataInsert = [
            'product_id' => $product->id,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message'],
            'contact_number' => $validatedData['contact_number'] ?? null,
            'province_id' => $validatedData['province'] ?? null,
            'city_id' => $validatedData['city'] ?? null,
            'barangay_id' => $validatedData['barangay'] ?? null,
        ];

        // Save the inquiry to the database
        Inquiry::create($dataInsert);

        // Send the response email
        Mail::to($validatedData['email'])->send(new InquiryResponse($data));


        // Optionally, you can add feedback to the user
        $this->showSuccessMessage = true;

        $this->loading = false;

        // Clear form fields after submission
        $this->reset(['name', 'email', 'contact_number', 'province', 'city', 'barangay', 'message']);

        // Automatically hide success message after 5 seconds
        $this->dispatch('hide-success-message', ['delay' => 2000]);


    }


    /**
     * Dismiss the success message.
     *
     * @return void
     */
    public function dismissSuccessMessage()
    {
        $this->showSuccessMessage = false;
    }
}
