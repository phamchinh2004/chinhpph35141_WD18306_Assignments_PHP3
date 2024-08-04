<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listOfProducts = Product::leftJoin('product_variants as pv', 'products.id', '=', 'pv.product_id')
            ->leftJoin('categories as ctg', 'products.category_id', '=', 'ctg.id')
            ->select('products.*', DB::raw('COUNT(pv.id) as total_variants'), 'ctg.name as category_name')
            ->where('products.is_active', '=', 1)
            ->groupBy('products.id')
            ->paginate(10);
        if ($listOfProducts->isEmpty()) {
            return view('app.admin.products.index', ['listOfProducts' => $listOfProducts, 'i' => 0]);
        }

        return view('app.admin.products.index', compact('listOfProducts'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.admin.products.create');
    }

    public function createTemporary(Request $request)
    {
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->is_active = 2;
            $product->save();
            return redirect()->back()->with('statusSuccess', 'Đã vô hiệu hóa sản phẩm!');
        }
        return redirect()->back()->with('statusError', 'Không tìm thấy sản phẩm cần vô hiệu hóa!');
    }
}
