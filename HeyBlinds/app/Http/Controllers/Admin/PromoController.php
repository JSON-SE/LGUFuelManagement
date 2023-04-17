<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Slider;
use App\Models\Subpromo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Admin\Promo\Promo;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PromoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PromoResource;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Category\Category;
use App\Models\Admin\Category\SubCategory;


class PromoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $promos = Promo::query()->orderByDesc('start_date');
            return DataTables::of($promos)
                ->addIndexColumn()
                ->addColumn('start_date', function ($row) {
                    return date('d-m-Y H:i:s', strtotime($row->start_date));
                })
                ->addColumn('end_date', function ($row) {
                    return date('d-m-Y H:i:s', strtotime($row->end_date));
                })
                ->addColumn('banner_is', function ($row) {
                    return $this->isBanner($row->id);
                })
                ->addColumn('extra_amount', function ($row) {
                    return $row->extra_amount ?? 0;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn text-secondary" href="' . route('admin.promo.edit', $row['external_id']) . '">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square"
                                viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" /><path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" /></svg></a>';
                    $btn = $btn . '<button class="btn" type="button" onclick="deletePromo(' . $row['id'] . ')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"> <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg></button>';
                    return $btn;
                })
                ->setRowClass(function ($row) {
                    return $this->activePromo($row->id) == true ? "alert-success" : "";
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.promo.index');
    }
    public function isBanner($id)
    {
        $slider = Slider::where('promo_id', $id)->first();
        if (!empty($slider->slider_link)) {
            return "Yes";
        }
        return "No";
    }
    public function activePromo($promo_id)
    {
        $active_promo = Promo::where('is_active', true)->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())->orderBy('created_at', 'desc')->select('id')->first();
        if ($active_promo) {
            if ($active_promo->id == $promo_id) {
                return true;
            }
        }
        return false;
    }

    public function create()
    {
        $subCategories = SubCategory::all();
        $products = Product::all();
        return view('admin.promo.create', compact('products', 'subCategories'));
    }

    public function store(PromoRequest $request)
    {
        $extraPromo = array();
        try {
            if(isset($request->discount_type) ){
                foreach($request->discount_type as $key => $rb){
                    $sub_cat = "dorp_down_subcategori_list_".$key;
                    $product_cat = "dorp_down_product_list_".$key;
                    $extraPromo[] = [ 
                        "categories_id" => $request->$sub_cat ?? null, 
                        "products_id" => $request->$product_cat ?? null,
                        "discount_type"=> $request->discount_type[$key] ?? null,
                        "discount_amount" => $request->discount_amount[$key] ?? null, 
                        "extra_discount_amount" => $request->extra_discount_amount[$key] ?? null ];
                } 
            }

            DB::beginTransaction();
            if (!empty($request->file('banner'))) {
                $featureImage = $this->helpers->uploadImage($request->file('banner'), 'promo');
            }
            $promo = Promo::create([
                'external_id' => Str::uuid(),
                'name' => $request->input('name'),
                'code' => $this->helpers->generateCouponCode(20),
                'discount_type' => $request->input('type'),
                'amount' => $request->input('amount'),
                'extra_amount' => $request->input('extra_amount'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'ticker' => $request->input('ticker'),
                'is_active' => $request->input('is_active') ?? false,
                'hide_timer' => $request->input('hide_timer') ?? false,
                'category' => json_encode($request->input('category_id')) ?? [],
                'product' => json_encode($request->input('product_id')) ?? [],
                'product_specific_discount' => json_encode($extraPromo) ,
                'content' => $request->input('content'),
                'mob_text_bar' => $request->input('mob_text_bar'),
                'coupon_text_box' => $request->input('coupon_text_box'),
                'created_by' => Auth::guard('admin')->id(),
            ]);

            Slider::insert([
                [
                    'promo_id' => $promo->id,
                    'media_id' => $featureImage ?? null,
                    'slider_link' => $request->input('banner_link'),
                    'is_active' => true,
                    'order_by' => 1,
                ], [
                    'promo_id' => $promo->id,
                    'media_id' => null,
                    'slider_link' => 'https://heyblinds.ca/warranty',
                    'is_active' => true,
                    'order_by' => 1,
                ]
            ]);
         
            if(isset($request->discount_type) ){
                foreach($extraPromo as $key => $sub_product){
                
                    foreach($sub_product['products_id'] ?? [] as $sub_pudc){
                        Subpromo::create([
                            'promo_id' => $promo->id,
                            'product_id' => $sub_pudc,
                            'sub_categories_id' => null,
                            'promo_type' => $sub_product['discount_type'] ?? null,
                            'discount'=>$sub_product['discount_amount'] ?? 0,
                            'extra_discount' => $sub_product['extra_discount_amount'] ?? 0,
                        ]);
                    }
                }
            }
         
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('admin.promo.index', $promo->external_id)->with('success', 'Promo Created Successfully.');;
    }

    public function edit($id)
    {

        $subCategories = SubCategory::where('category_id',1)->get();
        $products = Product::where('is_live', 1)
        ->where('draft', 0)
        ->where('display_media_id', '!=', null)
        ->whereHas('price')
        ->whereHas('options')
        ->get();
        $promo = Promo::where('external_id', $id)->firstOrFail();
        // return json_decode( $promo->product_specific_discount);
        $sliders = Slider::where('promo_id', $promo->id)->orderBy('order_by', 'asc')->get();
        $subcategories =  SubCategory::all();

       // $products = Product::all();
        return view('admin.promo.edit', compact('products', 'subCategories', 'promo', 'sliders', 'subcategories'));
    }

    public function update(PromoRequest $request, $id)
    {
        $extraPromoUpdate = [];
        // return $request->input('type');
        try {
        DB::beginTransaction();
            if(isset($request->discount_type) ){
                foreach($request->discount_type as $key => $rb){
                    $sub_cat = "dorp_down_subcategori_list_".$key;
                    $product_cat = "dorp_down_product_list_".$key;
                 
                    $extraPromoUpdate[] = [ 
                        "categories_id" => $request->$sub_cat ?? null, 
                        "products_id" => $request->$product_cat ?? null, 
                        "discount_type"=> $request->discount_type[$key] ?? null,
                        "discount_amount" => $request->discount_amount[$key] ?? null,
                        "extra_discount_amount" => $request->extra_discount_amount[$key] ?? null ];

                }
            }
            if (!empty($request->file('banner'))) {
                $media_id = $this->helpers->uploadImage($request->file('banner'), 'promo');
                $this->sliderUpdate($media_id, $request, $id);
            }
            if (!empty($request->banner_link) && !empty($request->banner)) {
                $this->sliderLinkUpdate($request->banner_link, $id);
            }
            $promo = Promo::findOrFail($id);

            $promo->name = $request->input('name');
            $promo->discount_type = $request->input('type');
            $promo->amount = $request->input('amount');
            $promo->extra_amount = $request->input('extra_amount');
            $promo->start_date = $request->input('start_date');
            $promo->end_date = $request->input('end_date');
            $promo->ticker = $request->input('ticker');
            $promo->is_active = $request->input('is_active') ?? false;
            $promo->hide_timer = $request->input('hide_timer') ?? false;
            $promo->category = json_encode($request->input('category_id')) ?? [];
            $promo->product = json_encode($request->input('product_id')) ?? [];
            $promo->product_specific_discount = json_encode($extraPromoUpdate) ;
            $promo->content = $request->input('content');
            $promo->mob_text_bar = $request->input('mob_text_bar');
            $promo->coupon_text_box = $request->input('coupon_text_box');
            $promo->updated_by = Auth::guard('admin')->id();
            $promo->save();
            // return $extraPromoUpdate;

            if (Subpromo::where('promo_id',$promo->id)->count() > 0) {
                Subpromo::where('promo_id',$promo->id)->delete();
             }
            if(isset($request->discount_type) ){
                foreach($extraPromoUpdate as $key => $sub_product){
                
                    foreach($sub_product['products_id'] as $sub_pudc){

                        Subpromo::where('product_id',$sub_pudc)->where('promo_id',$promo->id)->updateOrCreate(
                            [
                                'promo_id' => $promo->id

                            ],[
                            'promo_id' => $promo->id,
                            'product_id' => $sub_pudc,
                            'sub_categories_id' => null,
                            'promo_type' => $sub_product['discount_type'] ?? null,
                            'discount'=>$sub_product['discount_amount'] ?? 0,
                            'extra_discount' => $sub_product['extra_discount_amount'] ?? 0,
                        ]);
                    }
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect()->route('admin.promo.index')->with(['success' => "Promo Saved Successfully."]);  //response($request);
    }
    /*
      * slider image  update
     */
    private function sliderUpdate($media_id, $request, $promo_id)
    {
        $slider = Slider::where('promo_id', $promo_id)->first();
        if ($slider) {
            Slider::where('id', $slider->id)->update([
                'media_id' => $media_id ?? null,
                'slider_link' => $request->input('banner_link'),
            ]);
        } else {
            Slider::insert([
                [
                    'promo_id' => $promo_id,
                    'media_id' => $media_id ?? null,
                    'slider_link' => $request->input('banner_link'),
                ], [
                    'promo_id' => $promo_id,
                    'media_id' => null,
                    'slider_link' => 'https://heyblinds.ca/warranty',
                ]
            ]);
        }
    }
    /*
      * slider link update
     */
    private function sliderLinkUpdate($url, $promo_id)
    {
        $check = Slider::where('promo_id', $promo_id)->where('media_id', '!=', NULL)->first();
        if ($check) {
            Slider::where('promo_id', $promo_id)->where('media_id', '!=', NULL)->update([
                'slider_link' => $url,
            ]);
        } else {
            Slider::insert([
                [
                    'slider_link' => $url ?? null,
                ],
                [
                    'slider_link' => 'https://heyblinds.ca/warranty',
                ]
            ]);
        }
    }

    public function destroy(Promo $promo)
    {
        $specific_products = json_decode($promo->product_specific_discount) ?? [] ;
        if(!empty($specific_products)){
            foreach($specific_products as $product_specific){
                $product = Product::whereIn('id', $product_specific->products_id)->update([
                    'promo_discount' => 0,
                    'promo_extra_amount' => 0,
                    'promo_type' => null
                ]);
            }
        }
            
        $delete = $promo->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfull.'
        ]);
    }

    public function extra_field_destroy(Request $request, Promo $promo){
        // return $request->all();
        $promos = Promo::findOrFail($request->promo_id);

        $extraDiscount = json_decode($promos->product_specific_discount);

        if(!empty($extraDiscount)){
            foreach($extraDiscount as $k => $val) {

              // unset($extraDiscount[$k]);

                if($k == (int)$request->extra_field_id) {
                     
               
                     $sub_promo = Subpromo::whereIn('product_id',$val->products_id)->where('promo_id',$promos->id)->get();

                     if(!empty($sub_promo)){


                            Subpromo::whereIn('product_id',$val->products_id)->where('promo_id',$promos->id)->delete();
                     }
                     
                    unset($extraDiscount[$k]);

             
                }
                
              }
              $extraDiscount= array_values($extraDiscount);
            //   if(!empty($extraDiscount)){
            //     $extraDiscount = $this->fix_keys($extraDiscount);
            //   }

             $promos->product_specific_discount = json_encode($extraDiscount) ;
            $promos->save();
        }
        // return $extraDispount;
        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfull.'
        ]);
    }
    public function fix_keys($array) {

       foreach ($array as $k => $val) {
   
           if (is_array($val)) 
               $array[$k] = $fix_keys($val); //recurse
       }
   
       if( is_numeric($k) )
           return array_values($array);
   
       return $array;
    }
}
