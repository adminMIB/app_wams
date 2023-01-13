<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable = ["product_name", "product_quantity", "harga_product", "total","list_id"];

    public function lists()
    {
        return $this->belongsTo(SalesOrder::class, 'list_id');
    }
}
