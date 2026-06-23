<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Category::select('id', 'catename', 'slug', 'image', 'status')
            ->orderBy('catename')
            ->orderBy('id')
            ->paginate(6);

        return view('admin.categories.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
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
                $image->move(public_path('images/categories'), $imageName);
            }

            Category::create([
                'catename'    => $request->catename,
                'slug'        => $request->slug,
                'image'       => $imageName,
                'status'      => $request->status,
                'sort_order'  => $request->sort_order ?? 0,
                'description' => $request->description,
            ]);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Thêm loại sản phẩm thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try {
            $imageName = $category->image;

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,jpg,png,gif,webp|max:2048',
                ]);

                if ($category->image && file_exists(public_path('images/categories/' . $category->image))) {
                    unlink(public_path('images/categories/' . $category->image));
                }

                $image     = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/categories'), $imageName);
            }

            $category->update([
                'catename'    => $request->catename,
                'slug'        => $request->slug,
                'image'       => $imageName,
                'status'      => $request->status,
                'sort_order'  => $request->sort_order ?? 0,
                'description' => $request->description,
            ]);

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Cập nhật loại sản phẩm thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $hasProducts = DB::table('products')
            ->where('cateid', $category->id)
            ->exists();

        if ($hasProducts) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Không thể xóa loại sản phẩm đang có sản phẩm liên kết.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Xóa loại sản phẩm thành công.');
    }
}
