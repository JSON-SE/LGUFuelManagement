<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductReviewRequest;
use App\Http\Requests\ReviewRequest;
use App\Models\Admin\Category\SubCategory;
use App\Models\Admin\Product\Product;
use App\Models\ProductReview;
use App\Models\Province;
use App\Models\Review;
use App\Notifications\ReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class ReviewController extends Controller
{

    public function showReviewsPage(){
        $reviews = Review::where('status',1)->orderByDesc('created_at')->paginate(16);
        return view('frontend.reviews-of-heyblinds',compact('reviews'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proviences = Province::all();
         $products = Product::where('show_home_page',1)->where('is_live', 1)
          ->where('draft', 0)
          ->where('display_media_id', '!=', null)
          ->whereHas('price')
          ->with('subCategory',function($query){
                $query->where('is_active',1);
          })
          ->whereHas('options')
          ->orderBy('order_by','asc')
          ->get();
        return view('frontend.review',compact('proviences','products'));
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
    public function store(ReviewRequest $request)
    {
        $review = Review::create([
            'rating_point' => $request->rating_point,
            'name' => $request->full_name,
            'review' =>$request->review,
            'title_review' => $request->title_review,
            'city' => $request->city,
            'email' => $request->email,
            'province' => $request->province,
            'customer_suggestion' => $request->customer_suggestion
        ]);

        Notification::route('mail',  ['help@heyblinds.ca'])->notify(new ReviewNotification($review));

        return response()->json([
            'status' => true,
            'message' => 'Thanks for your review.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::where('sub_category_id',$id)
        ->where('is_live', 1)
          ->where('draft', 0)
          ->where('display_media_id', '!=', null)
          ->with('price',function($query){
              $query->where('width','>=',12)->where('height', '>=', 12);
          })
          ->whereHas('options')
          ->orderBy('order_by','asc')
          ->get();
          return response()->json([
                'status' => true,
                'products' => $products,
          ]);
        
    }
    public function productReview(ProductReviewRequest $request){
        $review = ProductReview::create([
            'rating_point' => $request->rating_point,
            'product_id' => $request->product_id,
            'title_review' => $request->title_review,
            'name' => $request->full_name,
            'email' => $request->email,
            'province' => $request->province,
            'review' => $request->review,
            'city' => $request->city,
            'customer_suggestion' => $request->customer_suggestion,
        ]);
        Notification::route('mail',  ['help@heyblinds.ca'])->notify(new ReviewNotification($review));
        
        return response()->json([
            'status' => true,
            'message' => 'Thanks for your review.'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
