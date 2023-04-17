<?php

namespace App\Models\Admin\Promo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoMeta extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'promo_metas';
    protected $primaryKey = 'id';

    public function getRouteKeyName() {
        return 'id';
    }

}
