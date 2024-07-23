<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Carousel extends Component
{
    public $images = [
        [
            'src' => 'image1.jpg',
            'title' => 'Image 1 Title',
        ],
        [
            'src' => 'image2.jpg',
            'title' => 'Image 2 Title',
        ],
        // Add more images as needed
    ];

    public $activeIndex = 0;

    public function mount()
    {
        $this->activeIndex = 0; // Start with the first image
    }

    public function next()
    {
        $this->activeIndex = ($this->activeIndex + 1) % count($this->images);
    }

    public function previous()
    {
        $this->activeIndex = ($this->activeIndex - 1 + count($this->images)) % count($this->images);
    }

    public function render()
    {
        return view('livewire.carousel');
    }
}
