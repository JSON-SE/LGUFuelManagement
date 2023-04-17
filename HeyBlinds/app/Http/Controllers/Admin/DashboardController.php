<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function removeMedia(Request $request,$id){
        $media = Media::find($id);
        if($media){
            $media->delete();
            return response()->json([
                'status' => true,
                'message' => "Successfully deleted."
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => "Something went wrong"
        ]);
    }
}
