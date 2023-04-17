<?php

namespace App\Models\Admin\Tax;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTax extends Model
{
    use HasFactory;
    protected $table = "sales_taxes";
    protected $guarded = [];
}
