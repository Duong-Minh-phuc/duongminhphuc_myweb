<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Brand::select(
            'id',
            'brandname',
            'slug',
            'image',
            'status'
        )
            ->orderBy('brandname')
            ->paginate(5);

        return view('admin.brands.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
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
                $image->move(public_path('images/brands'), $imageName);
            }

            Brand::create([
                'brandname'   => $request->brandname,
                'slug'        => $request->slug,
                'image'       => $imageName,
                'status'      => $request->status,
                'sort_order'  => $request->sort_order ?? 0,
                'description' => $request->description,
            ]);

            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Thêm thương hiệu thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        try {
            $imageName = $brand->image;

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,jpg,png,gif,webp|max:2048',
                ]);

                if ($brand->image && file_exists(public_path('images/brands/' . $brand->image))) {
                    unlink(public_path('images/brands/' . $brand->image));
                }

                $image     = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/brands'), $imageName);
            }

            $brand->update([
                'brandname'   => $request->brandname,
                'slug'        => $request->slug,
                'image'       => $imageName,
                'status'      => $request->status,
                'sort_order'  => $request->sort_order ?? 0,
                'description' => $request->description,
            ]);

            return redirect()
                ->route('admin.brands.index')
                ->with('success', 'Cập nhật thương hiệu thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $hasProducts = DB::table('products')
            ->where('brandid', $brand->id)
            ->exists();

        if ($hasProducts) {
            return redirect()
                ->route('admin.brands.index')
                ->with('error', 'Không thể xóa thương hiệu đang có sản phẩm liên kết.');
        }

        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Xóa thương hiệu thành công');
    }
}
