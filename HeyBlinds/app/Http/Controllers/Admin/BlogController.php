<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CommentResource;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\BlogCategory;
use App\Models\Media;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $blogs = Blog::query()->orderByDesc('created_at');
            return DataTables::of($blogs)
            ->addIndexColumn()
            ->addColumn('image',function($row){
                    return '<div class="table-colour-imge"><img src = "'.$this->helpers->getThumbnail($row['media_id']).'"></div>';
               })
                ->addColumn('status',function($row){
                    if($row['status'] == 1){
                        return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUnchecked('.$row['id'].')" checked />';
                    }
                     return '<input class="form-check-input" type="checkbox" value="1" id="show_home_page" name="show_home_page" onclick="checkedUnchecked('.$row['id'].')" />';
                })
                ->addColumn('action', function ($row) {
                        
                        $btn = '<a href="'.url('/blog/'.$row['slug']).'" target="_blank" class="btn btn-sm text-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                        $btn = $btn.'<a href="'.route('admin.blog.edit',$row['id']).'" class="btn btn-sm text-primary"><i class="fa fa-edit" aria-hidden="true"></i></a>';
                        
                        $btn = $btn.'<a href="javascript:void(0)" onclick="deleteBlog('.$row['id'].')" class="btn btn-sm text-primary"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        $btn = $btn.'<a href="'.route('admin.comment.index',$row['id']).'" class="btn btn-sm text-primary">Show Comments</a>';
                        return $btn;
                })
            //     ->addColumn('name', function ($row) {
            //         return $row->name ?? ''; 
            //    })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d'); // human readable format
                    })
                ->filterColumn('created_at', function ($query, $keyword) {
                        $query->whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d') like ?", ["%$keyword%"]); //date_format when searching using date
                    })
                ->rawColumns(['image','status','action'])
                ->make(true);
        }
        return view('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::where('status',1)->get();
        return view('admin.blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:blogs',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category'  => 'required',
            'description'  => 'required',

        ],[
            'image.image' => 'The file must be an image',
           
        ]);

        try{
            DB::beginTransaction();
            if (!empty($request->file('image'))){
                $media_id = $this->helpers->uploadImage($request->file('image'), 'blog');
            }
            $blog = Blog::create([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => Str::slug($request->name,'-'),
                'media_id' => $media_id,
                'author_by' => $request->author_by,
                'written_by' => $request->written_by,
            ]);
            $blog->categories()->attach($request->category);
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        return redirect()->route('admin.blog.index')->with(['success' => "Successfully Created."]);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
      

    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::where('status',1)->get();
        return view('admin.blog.edit', compact('blog','categories'));
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
        $request->validate([
            'name' => 'required|unique:blogs,name,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category'  => 'required',
            'description'  => 'required',
        ],[
            'image.image' => 'The file must be an image',
             
        ]);
        try{
            $blog = Blog::findOrFail($id);
            DB::beginTransaction();
            if (!empty($request->file('image'))){
               $media_id = $this->helpers->uploadImage($request->file('image'), 'blog');
               $blog->update(['media_id' => $media_id]);
            }
            $blog->update([
                'name' => $request->name,
                'description' => $request->description,
                'slug' => Str::slug($request->name,'-'),
                'author_by' => $request->author_by,
                'written_by' => $request->written_by,
            ]);
            $blog->categories()->sync($request->category);
           DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        return redirect()->route('admin.blog.index')->with(['success' => "Successfully Updated."]);
    }

    public function updateStatus(Request $request, $id)
    {
        $blog = Blog::find($id);
        if($blog->status == 1){
             $blog->update(['status' => 0]);
        }
        else{
            $blog->update(['status' => 1]);
        }
        return response()->json([
            'status' => true,
            'message' => 'Updated successfully.',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if($blog){
            $media = Media::where('id',$blog->media_id)->first();
            $media->delete();
            $blog->delete();
        }
        return response()->json([
            'status' => true,
            'message' => 'Successfully Deleted.',
        ]);
    }
    public function imageUpload(Request $request){
        $file = $request->file;
        $extension = $file->getClientOriginalExtension();
        $OrgthumbPath = "";
        $fileName = $this->createFilename($file);
        $mime = str_replace('/', '-', $file->getMimeType());
        $dateFolder = date("Y-m-W");
        $filePath = "public/upload/{$mime}/{$dateFolder}";

        $path = Storage::disk('s3')->put($filePath, $file, 'public');
        $OrgPath = Storage::disk('s3')->url($path);

        if (Str::contains($mime, ['images', 'image', 'jpg', 'jpeg', 'png', 'gif']) ){

            $uploadedPath =  "public/upload/{$mime}/{$dateFolder}/thumbnail/{$fileName}";
            $resize = Image::make($file)->resize(150, 150 )->encode($extension, 100);

            Storage::disk('s3')->put($uploadedPath, $resize->__toString(),'public');
            $OrgthumbPath = Storage::disk('s3')->url($uploadedPath);
        }
       return   $OrgPath;

    }
    protected function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace(".".$extension, "", $file->getClientOriginalName()); // Filename without extension

        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;

        return $filename;
    }
}
