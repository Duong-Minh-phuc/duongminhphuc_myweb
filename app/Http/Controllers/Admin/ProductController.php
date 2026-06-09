<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            ->orderBy('products.productname', 'asc')
            ->paginate(8);

        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }
}
