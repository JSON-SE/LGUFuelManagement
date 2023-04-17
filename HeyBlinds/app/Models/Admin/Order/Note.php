<?php

namespace App\Models\Admin\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'notes';

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
