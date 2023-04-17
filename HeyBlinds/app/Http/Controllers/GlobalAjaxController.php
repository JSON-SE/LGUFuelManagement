<?php

namespace App\Http\Controllers;


use Session;
use App\Models\Media;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Front\Cart\Cart;
use App\Models\AbandonedCustomer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Models\Front\Cart\CartItem;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use App\Notifications\SavedAbandonedCartNotification;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;

class GlobalAjaxController extends Controller
{
    public function sort(Request $request)
    {
        parse_str($request->data, $sortData);
        if (!empty($sortData['item'])) {
            foreach ($sortData['item'] as $key => $sort) {
                DB::table("{$request->input('t')}")->where($request->input('where'), $sort)->update([
                    "order_by" => $key
                ]);
            }
        }
    }
    public function sortProductSlideImage(Request $request)
    {
        parse_str($request->data, $sortData);
        $data = [];
        foreach ($sortData['item'] as $key => $value) {
            $data[] = $value;
        }
        if (!empty($data)) {
            DB::table("products")->where('id', $request->request_id)->update([
                'slider_id' => $data
            ]);
        }
        $product = DB::table("products")->where('id', $request->request_id)->first();

        return response()->json([
            'status' => true,
            'data' => json_decode($product->slider_id, 1),
            'message' => 'Updated successfully.'
        ]);
    }

    public function upload(Request $request)
    {
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        $save = $receiver->receive();
        if ($save->isFinished()) {
            return $this->saveFileToS3($save->getFile());
        }
        $handler = $save->handler();
        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }

    protected function saveFileToS3($file)
    {
        return $this->resizeImage($file);
    }

    public function resizeImage($file)
    {
        $extension = $file->getClientOriginalExtension();
        $OrgthumbPath = "";
        $fileName = $this->createFilename($file);
        $mime = str_replace('/', '-', $file->getMimeType());
        $dateFolder = date("Y-m-W");
        $filePath = "public/upload/{$mime}/{$dateFolder}";

        $path = Storage::disk('s3')->put($filePath, $file, 'public');
        $OrgPath = Storage::disk('s3')->url($path);

        if (Str::contains($mime, ['images', 'image', 'jpg', 'jpeg', 'png', 'gif', 'webp'])) {

            $uploadedPath =  "public/upload/{$mime}/{$dateFolder}/thumbnail/{$fileName}";
            $resize = Image::make($file)->resize(150, 150)->encode($extension, 100);

            Storage::disk('s3')->put($uploadedPath, $resize->__toString(), 'public');
            $OrgthumbPath = Storage::disk('s3')->url($uploadedPath);
        }

        $media = Media::create([
            'name' => $fileName,
            'original_path' => $path,
            'thumb_path' => $uploadedPath,
            'original_url' => $OrgPath,
            'thumb_url' => $OrgthumbPath,
            'mime' => $mime,
        ]);

        if (!empty($media->id)) {
            return response()->json($media);
        } else {
            return false;
        }
    }

    protected function saveFile(UploadedFile $file)
    {
        $fileName = $this->createFilename($file);
        // Group files by mime type
        $mime = str_replace('/', '-', $file->getMimeType());
        // Group files by the date (week
        $dateFolder = date("Y-m-W");
        // Build the file path
        $filePath = "public/upload/{$mime}/{$dateFolder}/";
        $finalPath = storage_path("app/" . $filePath);
        $uploadedPath =  "upload/{$mime}/{$dateFolder}/";

        // move the file name
        $file->move($finalPath, $fileName);

        if (!Str::contains($mime, 'video')) {
            $thumbnailPath = storage_path("app/" . $filePath . 'thumbnail/');

            if (!file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 666, true);
            }

            $resize = Image::make($finalPath . $fileName)->resize(150, 150);
            $resize->save($thumbnailPath . $fileName, 80);
        }

        $media = Media::create([
            'name' => $fileName,
            'original_path' => "/storage/{$uploadedPath}{$fileName}",
            'thumb_path' => !Str::contains($mime, 'video') ? "/storage/{$uploadedPath}thumbnail/{$fileName}" : "",
            'original_url' => Storage::url("{$uploadedPath}{$fileName}"),
            'thumb_url' => !Str::contains($mime, 'video') ? Storage::url("{$uploadedPath}thumbnail/{$fileName}") : "",
            'mime' => $mime,
        ]);

        return response()->json([
            'path' => $uploadedPath,
            'name' => $fileName,
            'mime_type' => $mime,
            'media_id' => $media->id
        ]);
    }

    protected function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace("." . $extension, "", $file->getClientOriginalName()); // Filename without extension

        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;

        return $filename;
    }

    public function SavedAbandonedCart($external_id)
    {
        $cart = Cart::where('external_id', $external_id)->first();
        // $cartItemsCount = CartItem::where('cart_id', $cart->id)->sum('quantity');
        $customer = AbandonedCustomer::where('cart_id', $cart->id)->first();
        $user = [
            'first_name' => $customer->shipping_first_name ?? '',
            'last_name' => $customer->shipping_last_name ?? '',
            'email' => $customer->shipping_email ?? '',
        ];
        Notification::route('mail', ['robert@heyblinds.ca', 'satya@klizos.com'])->notify(new SavedAbandonedCartNotification($user, $cart));
    }
    public function remberMeasure(Request $request)
    {
        Session::put('session_width', $request->session_width, 3600);
        Session::put('session_height', $request->session_height, 3600);
        Session::put('session_width_fraction', $request->session_width_fraction, 3600);
        Session::put('session_height_fraction', $request->session_height_fraction, 3600);
    }
    public function remberMeasureRetrive(Request $request)
    {
        if ((int)$request->max_width <= (int)Session::get('session_width')) {
            $session_width =  Session::get('session_width') ?? 24;
        } elseif ((int)$request->min_width >= (int)Session::get('session_width')) {
            $session_width =   24;
            Session::put('session_width', 24, 3600);
        } else {
            $session_width =   24;
            Session::put('session_width', 24, 3600);
        }
        if ((int)$request->max_height <= (int)Session::get('session_height')) {
            $session_height =  Session::get('session_height') ?? 36;
        } elseif ((int)$request->min_height >= (int)Session::get('session_height')) {
            $session_height =   36;
            Session::put('session_height', 36, 3600);
        } else {
            $session_height =   36;
            Session::put('session_height', 36, 3600);
        }
        return response()->json([
            'session_width' => $session_width ?? 24,
            'session_height' => $session_height ?? 36,
            'session_width_fraction' => Session::get('session_width_fraction'),
            'session_height_fraction' => Session::get('session_height_fraction'),
        ]);
    }
}
