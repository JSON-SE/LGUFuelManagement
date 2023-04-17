<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Seo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public Helpers $helpers;
    
    public function __construct()
    {
        $this->helpers = new Helpers();
    }
}
