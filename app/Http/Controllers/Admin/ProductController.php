<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
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
        $list = DB::table('products')
            ->join('categories', 'products.cateid', '=', 'categories.id')
            ->leftJoin('brands', 'products.brandid', '=', 'brands.id')
            ->select(
                'products.id',
                'products.productname',
                'products.price',
                'products.pricediscount',
                'products.image',
                'products.description',
                'products.status',
                'categories.catename',
                'brands.brandname'
            )
            ->orderBy('products.productname')
            ->paginate(8);

        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'catename')->get();
        $brands     = Brand::select('id', 'brandname')->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $imageName = null;

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,jpg,png,gif,webp|max:2048',
                ]);

                $image     = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/products'), $imageName);
            }

            Product::create([
                'productname'   => $request->productname,
                'slug'          => $request->slug,
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount,
                'image'         => $imageName,
                'description'   => $request->description,
                'status'        => $request->status,
            ]);
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Them sản phẩm thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

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
        $categories = Category::select('id', 'catename')->get();
        $brands     = Brand::select('id', 'brandname')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            if(empty($request->cateid)) {
                return back()
                    ->withInput()
                    ->with('error', 'Vui lòng chọn loại sản phẩm');
            }
            $product = Product::find($id);
            if (! $product) {
                return redirect()
                ->route('admin.products.index')
                ->with('error', 'Sản phẩm không tồn tại');
            }

            $imageName = $product->image;

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,jpg,png,gif,webp|max:2048',
                ]);

                if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
                    unlink(public_path('images/products/' . $product->image));
                }

                $image     = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/products'), $imageName);
            }

            $product->update([
                'productname'   => $request->productname,
                'cateid'        => $request->cateid,
                'brandid'       => $request->brandid,
                'price'         => $request->price,
                'pricediscount' => $request->pricediscount,
                'image'         => $imageName,
                'description'   => $request->description,
                'status'        => $request->status,
            ]);

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (! $product) {
            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm');
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Xóa thành công');
    }
}
