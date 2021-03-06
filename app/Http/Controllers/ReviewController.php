<?php

namespace App\Http\Controllers;

use App\Model\Review;

use App\Model\Product;

use Illuminate\Http\Request;

use App\Http\Resources\ReviewResource;

use App\Http\Requests\ReviewRequest;

use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product, $id)
    {      
        // return $product;
        // return Review::all();
        // return $product->reviews;
        // return new ReviewResource($product);

        return ReviewResource::collection($product::find($id)->reviews);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request, Product $product, $id)
    {
        // return "hi";
        $product = $product::find($id);

        $review = new Review($request->all());

        $product->reviews()->save($review); // insert the product id while creating the review

        return response([
            'data' => new ReviewResource($review)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $p_id, $r_id, Product $product)
    {
        //
        // return $r_id;
        // return $product;
        // return $review;

        $review = Review::find($r_id);

        $review->update($request->all());

        return response([
            'data' => new ReviewResource($review)
        ], Response::HTTP_CREATED);
    }

    public function checkUserReview($request)
    {
        // if(Auth::id() !== )
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, $p_id, $r_id )
    {
        //
        // return $r_id;
        // return $product;

        Review::find($r_id)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
