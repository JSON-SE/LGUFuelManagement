<?php

namespace App\Models\Admin\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleOrderNote extends Model
{
    use HasFactory;


    protected $guarded = [];
    protected $table = 'sample_order_notes';

    public function order(){
        return $this->belongsTo(SampleOrder::class);
    }

}
