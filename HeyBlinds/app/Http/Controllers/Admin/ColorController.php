<?php

namespace App\Http\Controllers\Admin;


use App\Exports\ColorExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\ColorResouce;
use App\Models\Admin\Color;
use App\Models\Admin\ColorGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Datatables;

class ColorController extends Controller
{
    /*
     * Display the color index page useing datatble
     * @param  Request $request 
     * @return Json
     */
    public function index(Request $request)
    {
        // $colors = Color::orderByDesc('created_at');
        // return ColorResouce::collection($colors->get());
        $allGroups = ColorGroup::all();
        if($request->ajax()){
            $colors = Color::orderByDesc('created_at');
            return DataTables::of(ColorResouce::collection($colors->get()))
            ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('admin.color.edit', $row['slug']).'" class="btn btn-sm text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" /></svg>
                    </a>';
                    $btn = $btn.'<button type="button" class="btn btn-sm " onclick="colorDelete('.$row['id'].')">
                        <div class="text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path></svg></div></button>';
                    return $btn;
                })
                ->addColumn('disclaimer',function ($row){
                   if($row['disclaimer'] == 1){
                        return '<input class="form-check-input check-all" type="checkbox" value="1" id="disclaimer" name="disclaimer" onclick="checkedUnchecked('.$row['id'].')" checked />';
                    }
                     return '<input class="form-check-input check-all" type="checkbox" value="1" id="disclaimer" name="disclaimer" onclick="checkedUnchecked('.$row['id'].')" />';
                })
                ->addColumn('color_image', function ($row) {
                    return '<div class="table-colour-imge"><img src="'.$this->helpers->getThumbnail($row['color_image_id']).'" alt="" /> </div>';
                })
                ->addColumn('feature_image', function ($row) {
                    return '<div class="table-colour-imge"><img src="'.$this->helpers->getThumbnail($row['feature_image_id']).'" alt="" /> </div>';
                })
                ->rawColumns(['color_image','feature_image','action','disclaimer'])
                ->make(true);
        }
        
        return view('admin.color.index', compact('allGroups'));
    }
    /**
     * Store the color
     *
     * @param Request $request
     *
     * @return mix
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor_color_name' => 'required',
            'vendor_color_id' => 'required|max:255',
            'color_group_id' => 'required',
            'name' => 'required|max:255',
            'color_id' => 'required|unique:colors|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'feature' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'quantity' => 'required',
        ],
        [
            'color_group_id.required' => 'The color group name field is required'
        ]);

        $data = $request->only('vendor_color_name', 'quantity', 'out_of_stock', 'vendor_color_id', 'name', 'color_id', 'color_group_id', 'is_enable', 'color_image_id', 'feature_image_id', 'created_by');

        if (!empty($request->file('image'))) {
            $image = $this->helpers->uploadImage($request->file('image'), 'color');
            $data['color_image_id'] = $image;
        }

        if (!empty($request->file('feature'))) {
            $featureImage = $this->helpers->uploadImage($request->file('feature'), 'color/feature');
            $data['feature_image_id'] = $featureImage;
        }

        if (DB::table('color_groups')->where('name', $request->color_group_id)->orWhere('id', $request->color_group_id)->doesntExist()) {
            $groupId = ColorGroup::create([
                'name' => $request->input('color_group_id'),
                'slug' => Str::slug($request->input('color_group_id')."-".$request->input('color_id'))
            ]);
            $data['color_group_id'] = $groupId->id;
        } else {
            $groupId = $request->input('color_group_id');
            $data['color_group_id'] = $groupId;
        }
        $data['created_by'] = Auth::id();
        $data['slug'] = Str::slug($request->input('name')."-".$request->input('color_id'));


        $color = Color::create($data);

        $collection = $color->toArray();
        if (!empty($color->color_image_id))
            $collection['image'] = $this->helpers->getThumbnail($color->color_image_id);
        if (!empty($color->feature_image_id))
            $collection['feature'] = $this->helpers->getThumbnail($color->feature_image_id);
        if (!empty($color->color_group_id))
            $collection['color_group_id'] = $color->group->name ?? "";


        return redirect()->route('admin.color.index')->with(['success' => 'Saved!']);
    }
    /**
     * store Csv File
     *
     * @param  mixed $request
     * @return void
     */
    public function storeCsvFile(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:20484',
        ], [
            'csv_file.mimes' => 'Allowed file type: .csv, .txt.',
        ]);
        $file = $request->file('csv_file');
        $fileName = Str::random(10) . time() . rand(0, 999) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('csv', $fileName);

        $data = $this->csvConvertArray($fileName);
        foreach ($data as $value) {
            if (Color::where('name', $value['name'])->orWhere('color_id', $value['color_id'])->doesntExist()) {
                Color::updateOrCreate(
                    [
                        'vendor_color_name' => $value['vendor_color_name'] ?? '',
                        'color_group_id' => $this->getColorGroup($value['color_group_id']),
                        'name' => $value['name'] ?? '',
                        'slug' => Str::slug($value['vendor_color_name']),
                        'color_id' => $value['color_id'],
                        'color_image_id' => 1,
                        'feature_image_id' => 1,
                        'is_enable' => 1,
                        'quantity' => $value['quantity'] ?? '',
                    ]
                );
            }
        }

        return redirect()->route('admin.color.index')->with(['success' => 'Saved!']);
    }
    /**
     * get color group
     *
     * @param int $findData
     *
     * @return int findData
     */
    public function getColorGroup($findData)
    {
        if (DB::table('color_groups')->where('name', $findData)->orWhere('id', $findData)->doesntExist()) {
            $groupId = ColorGroup::create([
                'name' => $findData,
                'slug' => Str::slug($findData),
            ]);
            return $groupId->id;
        }
        return $findData;
    }
    public function getDefaualtImage()
    {
        return $this->helpers->getThumbnail(0);
    }

    /**
     * Converting csv file
     *
     * @param $file
     * @return array format array
     */

    public static function csvConvertArray($file)
    {
        $filepath = 'storage/csv/' . $file;
        // Reading file
        $file = fopen($filepath, "r");
        $importData_arr = array();

        $header = [];
        $data = [];

        while (($filedata = fgetcsv($file, 1000, ",")) !== false) {

            $num = count($filedata);
            if (!$header) {
                $header = $filedata;
            } else {
                $data[] = array_combine($header, $filedata);
            }
        }
        fclose($file);
        return $data;
    }
    /**
     * Description
     *
     * @param string slug
     *
     * @return mix
     */

    public function edit($slug)
    {
        $allGroups = ColorGroup::all();
        $color = Color::where('slug', $slug)->first();
        return view('admin.color.edit', compact('color', 'allGroups'));
    }

    public function update(Request $request, $slug)
    {
        $request->validate([
            'name' => "required",
            'color_id' => "required|max:255|unique:colors,color_id,$slug,slug",
            'color_group_id' => "required|max:10",
            'vendor_color_id' => "required|max:255",
            'image' => "image|mimes:jpeg,png,jpg,gif,svg|max:3048",
            'feature' => "image|mimes:jpeg,png,jpg,gif,svg|max:3048",
            'quantity' => 'required',
        ],
        [
            'color_group_id.required' => 'The color group name field is required'  
        ]);
        $color = DB::table('colors')->where('slug', $slug)->first();

        $data = $request->only('vendor_color_name', 'quantity', 'vendor_color_id', 'name', 'color_id', 'color_group_id', 'is_enable', 'color_image_id', 'feature_image_id', 'created_by');
        if (!empty($request->file('image'))) {
            $image = $this->helpers->uploadImage($request->file('image'), 'color');
            $data['color_image_id'] = $image;
        }
        if (!empty($request->file('feature'))) {
            $featureImage = $this->helpers->uploadImage($request->file('feature'), 'color/feature');
            $data['feature_image_id'] = $featureImage;
        }
        if (DB::table('color_groups')->where('name', $request->color_group_id)->orWhere('id', $request->color_group_id)->doesntExist()) {
            $groupId = ColorGroup::create([
                'name' => $request->input('color_group_id'),
                'slug' => Str::slug($request->input('color_group_id')."-".$request->input('color_id'))
            ]);
            $data['color_group_id'] = $groupId->id;
        } else {
            $groupId = $request->input('color_group_id');
            $data['color_group_id'] = $groupId;
        }
        $data['created_by'] = Auth::id();
        $data['slug'] = Str::slug($request->input('name'))."-".$request->input('color_id');
        $data['is_enable'] = $request->input('is_enable');
        $data['out_of_stock'] = !empty($request->input('out_of_stock')) ? $request->input('out_of_stock') : 0;
        $data['disclaimer'] = $request->disclaimer ?? 0;

        if($color->quantity != $request->quantity){
            $data['remaining_quantity'] = 0;
        }
       
        $response = DB::table('colors')->where('slug', $slug)->update($data);

        if (!empty($response)) {
            return redirect()->back()->with('success', 'Successfully Updated');
            //return redirect()->route('admin.color.index')->with('success', 'Successfully Updated');
        }
        return back();
    }

    public function destroy($id)
    {
        $color = Color::findOrFail($id);
        $color->delete();
        return response()->json([
            'status' => true,
        ]);
    }
    /**
     * Color infor export
     * @param  Request $request 
     * @return File
     */
    public function export(Request $request){
        return Excel::download(new ColorExport(), 'color.xlsx');
    }

    public function checkedUpdate(Request $request){
        $colors = Color::all();
        if($request->data == 'checked'){
            foreach($colors as $color){
                $color->update(['disclaimer' => 1]);
                
            }
        }
        else{
            foreach($colors as $color){
                $color->update(['disclaimer' => 0]);
               
            }
        }
    }
    public function checkedUpdateOne($id){
        $color = Color::where('id',$id)->first();
        if($color->disclaimer == 1){
            Color::where('id',$id)->update(['disclaimer' => 0]);
            return "uncked";
        }
        else{
            Color::where('id',$id)->update(['disclaimer' => 1]);
              return "checked";
        }
    }
}
