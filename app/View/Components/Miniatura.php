<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Image;

class Miniatura extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */


    public function __construct(public string $src)
    {
        $this->url = $src;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        
        $image_resize = Image::make($this->url);
        $image_resize->resize(500, null, function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image_resize->orientate();
        $miniatura = base64_encode($image_resize);
        
        return view('components.miniatura', [$miniatura]);
    }
}