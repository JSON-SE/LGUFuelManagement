<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SubcriberExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubcriberResource;
use App\Models\Subcriber;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class SubcriberController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $subcriber = Subcriber::query()->orderBy('updated_at', 'desc');
            return DataTables::of(SubcriberResource::collection($subcriber->get()))
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.subcriber');
    }
    public function export(){
        return Excel::download(new SubcriberExport(), 'subcriber.xlsx');
    }
}
