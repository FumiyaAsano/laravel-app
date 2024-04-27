<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private static $PAGE_ITEM_COUNT = 10;

    public function index(Request $request) {
        $keyword = $request->input('keyword') ?? '';
        $company_id = $request->input('company_id') ?? '';
        $page = $request->input('page') ?? 1;

        return view(
            'product.index',
            [
                'products' => Product::findWithPagenation(
                    $keyword,
                    $company_id,
                    $page,
                    self::$PAGE_ITEM_COUNT
                ),
                'page_count' => max(ceil(Product::getItemCount(
                    $keyword,
                    $company_id
                ) / self::$PAGE_ITEM_COUNT), 1),
                'companies' => Company::all(),
                'company_names'=> Company::getNamesMap(),
                'keyword' => $keyword,
                "company_id" => $company_id,
                'page' => $page,
            ]
        );
    }

    public function viewRegister() {
        return view(
            'product.register',
            ['companies' => Company::all()]
        );
    }

    public function register(Request $request) {
        $product = new Product();
        $product->company_id = $request->input('company_id');
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');
        $product->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $file->storeAs("public/images/{$product->id}", $file_name);
            $product->img_path = "/images/{$product->id}/{$file_name}";
            $product->save();
        }

        return redirect()->route('product.register');
    }

    public function detail($id) {
        $product = Product::find($id);
        return view(
            'product.detail',
            [
                'company' => Company::find($product->company_id),
                'product' => $product,
            ]
        );
    }

    public function viewEdit($id) {
        return view(
            'product.edit',
            [
                'companies' => Company::all(),
                'product' => Product::find($id),
            ]
        );
    }

    public function edit(Request $request, $id) {
        $product = Product::find($id);
        $product->company_id = $request->input('company_id');
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->comment = $request->input('comment');
        $product->save();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = $file->getClientOriginalName();
            $file->storeAs("public/images/{$product->id}", $file_name);
            $product->img_path = "images/{$product->id}/{$file_name}";
            $product->save();
        }

        return redirect()->route('product.edit', $id);
    }

    public function delete(Request $request, $id) {
        $return_url = $request->input('return_url');

        Product::find($id)->delete();

        return redirect($return_url);
    }
}
