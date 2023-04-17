<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

//use GuzzleHttp\Client;

class KlaviyaController extends Controller
{
    /**
     * Retrive the data from Klaviya
     *
     * @return Json
     */
    public function index(){
        $res = Http::get('https://a.klaviyo.com/api/v1/metrics?api_key=pk_c72b2a21a845dc0919f01dc9b0aaf20caf&page=0&count=50');
        $response = json_decode($res->body(),1);
        return view('admin.klaviya.index',compact('response'));
    }
    /**
     * Asper matric ID retrive the data from Klaviya
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function show($id){
        $res = Http::get('https://a.klaviyo.com/api/v1/metric/'.$id.'/timeline?api_key=pk_c72b2a21a845dc0919f01dc9b0aaf20caf&count=50&sort=desc');
        $response = json_decode($res->body(),1);
       // return $response;
        return view('admin.klaviya.show',compact('response'));
    }
}
