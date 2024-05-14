<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public static function findWithFilters(
        $keyword,
        $company,
        $price_gte,
        $price_lte,
        $stock_gte,
        $stock_lte
    ) {
        $query = self::select([
            'products.id',
            'products.img_path',
            'products.product_name',
            'products.price',
            'products.stock',
            'companies.company_name',
        ])->join('companies', 'products.company_id', '=', 'companies.id');

        if ($keyword != '') {
            $query->where('product_name', 'like', '%' . $keyword . '%');
        }
        if ($company != '') {
            $query->where('company_id', '=', $company);
        }
        if ($price_gte != '') {
            $query->where('price', '>=', $price_gte);
        }
        if ($price_lte != '') {
            $query->where('price', '<=', $price_lte);
        }
        if ($stock_gte != '') {
            $query->where('stock', '>=', $stock_gte);
        }
        if ($stock_lte != '') {
            $query->where('stock', '<=', $stock_lte);
        }
        return $query->get();
    }
}
