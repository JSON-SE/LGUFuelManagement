<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductReviewResource;
use App\Http\Resources\WebsiteReviewResource;
use App\Models\Admin\Product\Product;
use App\Models\ProductReview;
use App\Models\Province;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Yajra\Datatables\Datatables;

class ReviewController extends Controller
{
    public function websiteReview(){
        return view('admin.review.website');
    }
    public function websiteReviewShow(Request $request){
        $reviews = Review::query()->orderByDesc('created_at');
        return DataTables::of($reviews)
        ->addIndexColumn()
        ->addColumn('status',function($row){
            if($row->status == 1){
                return '<input class="form-check-input" type="checkbox" value="1" id="review_status" name="review_status" onclick="checkedUnchecked('.$row->id.')" checked />';
            }
            return '<input class="form-check-input" type="checkbox" value="1" id="review_status" name="review_status" onclick="checkedUnchecked('.$row->id.')" />';
        })
        ->addColumn('hp_status',function($row){
            if($row->show_home_page == 1){
                return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUncheckedForHomePage('.$row->id.')" checked />';
            }
            return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUncheckedForHomePage('.$row->id.')" />';
        })
        ->addColumn('rating_point', function ($row) {
            $rating_point = ((100/5)*$row->rating_point);
            return '<div class="star-width">
            <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: '.$rating_point.'%"
            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="star-pro">
            <span>★</span>
            <span>★</span>
            <span>★</span>
            <span>★</span>
            <span>★</span>
            </div>
            </div>';
        })
        ->addColumn('action', function ($row) {
             $btn =  '<a href="'.route('admin.review.show', $row->id).'" class="btn btn-sm text-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path></svg></a>';
             $btn = $btn. '<button type="button" class="btn btn-sm " onclick="reviewDelete('.$row->id.')">
                        <div class="text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg></div></button>';
             return $btn;
        })
        ->editColumn('created_at', function ($row) {
            return $row->created_at->format('M d, Y'); // human readable format
        })
        ->rawColumns(['rating_point','status','action','hp_status'])
        ->make(true);
    }
    public function show($id){
        $review = Review::where('id',$id)->firstOrFail();
        $proviences = Province::all();
        return view('admin.review.web-review-edit',compact('review','proviences'));
    }
    
    public function reviewSatusActive(Request $request){
        $review = Review::where('id',$request->review_id)->first();
        if($review->status == 1){
            Review::where('id',$request->review_id)->update(['status' => 0]);
        }
        else{
            Review::where('id',$request->review_id)->update(['status' => 1]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Updated successfully.',
        ]);
    }
    public function reviewSatusActiveHomePage(Request $request){
        $review = Review::where('id',$request->review_id)->first();
        if($review->show_home_page == 1){
            Review::where('id',$request->review_id)->update(['show_home_page' => 0]);
        }
        else{
            Review::where('id',$request->review_id)->update(['show_home_page' => 1]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Updated successfully.',
        ]);

    }
    public function webReviewDelete($id){
        $review = Review::where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => "Review is Successfully deleted",
        ]);
    }

    //product review

    public function productReview(){
        return view('admin.review.product');
    }
    public function websiteUpdate(Request $request,$id){
        $review = Review::where('id',$id)->first();
           $review->update([
            'name' => $request->full_name,
            'review' =>$request->review,
            'title_review' => $request->title_review,
            'city' => $request->city,
            'email' => $request->email,
            'province' => $request->province,
            'customer_suggestion' => $request->customer_suggestion,
            'created_at' => date("Y-m-d H:i:s", strtotime($request->created_at)),
        ]);
        return redirect()->to('admin/review-of-website')->with('success',"Updated successfully.");
    }
    public function productShow($id){
         $review = ProductReview::where('id',$id)->firstOrFail();
         $proviences = Province::all();
         return view('admin.review.product-review-show',compact('review','proviences'));
    }

    public function productReviewShow(Request $request){
        $reviews = ProductReview::query()->with('product')->whereHas('product')->select('product_reviews.*')->orderBy('updated_at','desc');
        if($request->product_id){
            $reviews->where('product_id',$request->product_id);
        }
        return DataTables::of($reviews)
        ->addIndexColumn()
        //  ->addColumn('product_name',function($row){
        //     return $this->productName($row->product_id);
        // })
         
         ->addColumn('status',function($row){
            if($row['status'] == 1){
                return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUnchecked('.$row['id'].')" checked />';
            }
            return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUnchecked('.$row['id'].')" />';
        })
         ->editColumn('created_at', function ($row) {
            return $row->created_at->format('M d, Y'); // human readable format
        })
        ->addColumn('rating_point', function ($row) {
            $rating_point = ((100/5)*$row->rating_point);
           return '<div class="star-width">
           <div class="progress">
           <div class="progress-bar" role="progressbar" style="width: '.$rating_point.'%"
           aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
           </div>
           <div class="star-pro">
           <span>★</span>
           <span>★</span>
           <span>★</span>
           <span>★</span>
           <span>★</span>
           </div>
           </div>';

       })
        ->addColumn('action', function ($row) {
            $btn = '<a href="'.route('admin.review.product.show', $row['id']).'" class="btn btn-sm text-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path></svg></a>';
            $btn = $btn. '<button type="button" class="btn btn-sm " onclick="reviewDelete('.$row['id'].')">
                        <div class="text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg></div></button>';
             return $btn;
        })
        ->rawColumns(['rating_point','status','action'])
        ->make(true);
    }
    public function productName($product_id){
        $product = Product::find($product_id);
        return $product->name ?? ' ';
    }

    public function productUpdate(Request $request,$id){
            $review = ProductReview::where('id',$id)->first();
           $review->update([
            'name' => $request->full_name,
            'review' =>$request->review,
            'title_review' => $request->title_review,
            'city' => $request->city,
            'province' => $request->province,
            'customer_suggestion' => $request->customer_suggestion,
            'created_at' => date("Y-m-d H:i:s", strtotime($request->created_at)),
        ]);
        return redirect()->to('admin/review-of-product')->with('success',"Updated successfully.");
    }
    
    public function reviewStatusProductReview(Request $request){
        $review = ProductReview::where('id',$request->product_review_id)->first();
        if($review->status == 1){
            ProductReview::where('id',$request->product_review_id)->update(['status' => 0]);
        }
        else{
            ProductReview::where('id',$request->product_review_id)->update(['status' => 1]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Updated successfully.',
        ]);
    }

    
    public function productReviewDelete($id){
        $review = ProductReview::where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => "Review is Successfully deleted",
        ]);
    }
}
