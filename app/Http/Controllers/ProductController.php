<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            ->paginate(4);
        if ($listOfProducts->isEmpty()) {
            return view('app.admin.product.index', ['listOfProducts' => $listOfProducts, 'i' => 0]);
        }

        return view('app.admin.product.index', compact('listOfProducts'))
            ->with('i', (request()->input('page', 1) - 1) * 4);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('app.admin.product.create', compact('categories'));
    }

    public function createTemporary(Request $request)
    {
        $checkValidate = $request->validate([
            'name' => ['required', 'min:1', 'max:255'],
            'image' => ['required', 'file'],
            'purchase_price' => ['required', 'numeric'],
            'sale_price' => ['nullable', 'numeric', 'lt:purchase_price'],
            'description' => ['required'],
            'category_id' => ['required']
        ]);
        if ($checkValidate) {
            $file = $request->image;
            $fileExt = $file->getClientOriginalExtension();
            $fileName = time() . 'product.' . $fileExt;
            $file->move(public_path('uploads'), $fileName);
            $skuProduct = random_int(100, 10000);
            $dataNewProduct = [
                'name' => $request->name,
                'SKU' => $skuProduct,
                'image' => $fileName,
                'purchase_price' => $request->purchase_price,
                'sale_price' => $request->sale_price,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'created_at' => now()
            ];
            // dd($checkValidate);
            // session(['newProduct' => $dataNewProduct]);
            Product::create($dataNewProduct);
            return redirect()->route('productsManagerIndex')->with('statusSuccess', 'Added new product successfully!');
        }
        return back()->withErrors($checkValidate);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $product = Product::find($id);
        if ($product) {
            $categories = Category::all();
            return view('app.admin.product.edit', compact('product', 'categories'));
        } else {
            return back()->with('error', 'Không tìm thấy thông tin sản phẩm cần sửa!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $checkValidate = $request->validate([
                'name' => ['required', 'min:1', 'max:255'],
                'image' => ['nullable', 'file'],
                'purchase_price' => ['required', 'numeric'],
                'sale_price' => ['nullable', 'numeric', 'lt:purchase_price'],
                'description' => ['required'],
                'category_id' => ['required']
            ]);
            if ($checkValidate) {
                if ($request->hasFile('image')) {
                    $existingImage = public_path('uploads/') . $product->image;
                    if (file_exists($existingImage)) {
                        unlink($existingImage);
                    }
                    $file = $request->image;
                    $fileExt = $file->getClientOriginalExtension();
                    $fileName = time() . 'product.' . $fileExt;
                    $file->move(public_path('uploads'), $fileName);
                    $checkValidate['image'] = $fileName;
                } else {
                    unset($checkValidate['image']);
                }
                $checkValidate['updated_at'] = now();
                // dd($checkValidate);
                $product->update($checkValidate);
                return redirect()->route('productsManagerIndex')->with('statusSuccess', 'Updated product successfully!');
            }
            return back()->withErrors($checkValidate);
        } else {
            return back()->with('error', 'Không tìm thấy thông tin sản phẩm cần sửa!');
        }
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
