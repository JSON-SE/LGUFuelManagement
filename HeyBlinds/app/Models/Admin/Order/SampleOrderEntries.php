<?php

namespace App\Models\Admin\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Order\SampleOrder;


class SampleOrderEntries extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'sample_order_entries';


    public function order(){
        return $this->belongsTo(SampleOrder::class);
    }

}
