<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function buy(Request $request, $id) {
        try {
            $product = Product::find($id);
            if ($product->stock <= 0) {
                abort(500, 'ストックがありません');
            }
            $product->stock--;
            $product->save();

            $sale = new Sale();
            $sale->product_id = $id;
            $sale->save();
        } catch (\Throwable $th) {
            return abort(500, '更新に失敗しました');
        }

        return [
            'message' => 'OK',
        ];
    }
}
