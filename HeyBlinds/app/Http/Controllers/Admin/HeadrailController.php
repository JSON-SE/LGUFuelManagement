<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Headrail;
use App\Models\HeadrailOption;
use Illuminate\Http\Request;

class HeadrailController extends Controller
{
    public function headreailStore(Request $request){
       $prices =  $request->price;
        $headrail = Headrail::where('product_id',$request->product_id)->get();
        if(!empty($headrail)){
           $headrail = Headrail::where('product_id',$request->product_id)->delete();
            for ($i = 0; $i < count($prices); $i++){
                Headrail::where('product_id',$request->product_id)->updateOrCreate([
                    'product_id' => $request->product_id,
                    'max_width' => $request->input('max_width')[$i],
                    'min_width' => $request->input('min_width')[$i],
                    'price_type' => $request->input('price_type')[$i],
                    'price' => $request->input('price')[$i]??0,
                ]);
            }
       }else{
            for ($i = 0; $i < count($prices); $i++){
                $data = Headrail::where('product_id',$request->product_id)->updateOrCreate([
                    'product_id' => $request->product_id,
                    'max_width' => $request->input('max_width')[$i],
                    'min_width' => $request->input('min_width')[$i],
                    'price_type' => $request->input('price_type')[$i],
                    'price' => $request->input('price')[$i]??0,
                ]);
            }
       }
       $data = HeadrailOption::where('product_id',$request->product_id)->first();

        if($data){
           $data = HeadrailOption::where('product_id',$request->product_id)->update([
                'headrail_toltip' => $request->note,
                'tooltip_description' => $request->tooltip_description
           ]);
        }
        else{
            $data = HeadrailOption::create([
                'product_id' => $request->product_id,
                'tooltip_description' => $request->tooltip_description,
                'headrail_toltip' => $request->note,
           ]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Successfully updated.'
       ]);
    }
    public function delete($id){
        $headrail = Headrail::findOrfail($id);
        $headrail->delete();
        return response()->json([
            'status' => true,
            'status' => "Deteed Successfully"
        ]);
    }
    public function headrailLeftStatus(Request $request,$id){
        $option = HeadrailOption::where('product_id',$id)->first();
        if($option){
            HeadrailOption::where('product_id',$id)->update(['left_status' => $request->left_side_panel]);
        }
        else{
            HeadrailOption::where('product_id',$id)->create([
                'product_id' => $id,
                'left_status' => $request->left_side_panel,
                'right_status' => 0
            ]);
        }
    }
    public function headrailRightStatus(Request $request,$id){
        $option = HeadrailOption::where('product_id',$id)->first();
        if($option){
            HeadrailOption::where('product_id',$id)->update(['right_status' => $request->right_side_panel]);
        }
        else{
            HeadrailOption::where('product_id',$id)->create([
                'product_id' => $id,
                'right_status' => $request->right_side_panel,
                'left_status' => 0
            ]);
        }
    }
    public function SeparateBlinds($id){
        $option = HeadrailOption::where('product_id',$id)->first();
            if(!empty($option)){
                if($option->is_separate_blinds == 1){
                    $option->update(['is_separate_blinds' => 0]);
                }
                else{
                    $option->update(['is_separate_blinds' => 1]);
                }
            }
            else{
                 HeadrailOption::create([
                    'product_id' => $id,
                    'is_separate_blinds' => 1
                ]);
            }
    }
    public function headrailSatus($id){
        $option = HeadrailOption::where('product_id',$id)->first();
        if(!empty($option)){
            if($option->headrail_status == 1){
                $option->update(['headrail_status' => 0]);
            }
            else{
                $option->update(['headrail_status' => 1]);
            }
        }
        else{
            HeadrailOption::create([
                'product_id' => $id,
                'headrail_status' => 1
            ]);
        }
    }
}
