<?php
namespace App\libs;

use App\Helpers\Helpers;

trait HelperTrait{
    public Helpers $helpers;
    public function __construct()
    {
        $this->helpers = new Helpers();
    }
}
