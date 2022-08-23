<?php

namespace App\Http\Controllers\Api\Web;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get sliders
        $sliders = Slider::latest()->get();
        
        //return with Api Resource
        return new SliderResource(true, 'List Data Sliders', $sliders);
    }
}