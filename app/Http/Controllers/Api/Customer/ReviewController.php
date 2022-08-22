<?php

namespace App\Http\Controllers\Api\Customer;

use App\Models\Review;
use App\Http\Resources\ReviewResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //check review already
        $check_review = Review::where('order_id', $request->order_id)->where('product_id', $request->product_id)->first();

        if($check_review) {
            return response()->json($check_review, 409);
        }

        $review = Review::create([
            'rating'        => $request->rating,
            'review'        => $request->review,
            'product_id'    => $request->product_id,
            'order_id'      => $request->order_id,
            'customer_id'   => auth()->guard('api_customer')->user()->id
        ]);

        if($review) {
            //return success with Api Resource
            return new ReviewResource(true, 'Data Review Berhasil Disimpan!', $review);
        }

        //return failed with Api Resource
        return new ReviewResource(false, 'Data Review Gagal Disimpan!', null);
    }
}