<?php
namespace App\libs;

use App\Helpers\Helpers;

trait PreAppliedPromo{
    public Helpers $helpers;
    public function __construct()
    {
        $this->helpers = new Helpers();
    }
}
