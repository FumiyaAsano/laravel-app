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

    public static function findWithPagenation($keyword, $company, $page, $page_item_count) {
        $query = self::offset(($page - 1) * $page_item_count)->limit($page_item_count);
        if ($keyword != '') {
            $query->where('product_name', 'like', '%' . $keyword . '%');
        }
        if ($company != '') {
            $query->where('company_id', '=', $company);
        }
        return $query->get();
    }

    public static function getItemCount($keyword, $company) {
        $query = self::query();
        if ($keyword != '') {
            $query->where('product_name', 'like', '%' . $keyword . '%');
        }
        if ($company != '') {
            $query->where('company_id', '=', $company);
        }
        return $query->count();
    }
}
