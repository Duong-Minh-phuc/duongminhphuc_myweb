
@extends('admin.layouts.admin')

@section('title', 'Sửa sản phẩm')

@section('content')
<div class="border rounded bg-white p-4 shadow-sm">
    <h3 class="mb-4">Sửa sản phẩm</h3>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="row">

            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text"
                           name="productname"
                           class="form-control"
                           value="{{ old('productname', $product->productname) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text"
                           name="slug"
                           class="form-control"
                           value="{{ old('slug', $product->slug) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Loại sản phẩm</label>
                    <select name="cateid" class="form-select">
                        <option value="">-- Chọn loại sản phẩm --</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('cateid', $product->cateid) == $category->id ? 'selected' : '' }}>
                                {{ $category->catename }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Thương hiệu</label>
                    <select name="brandid" class="form-select">
                        <option value="">-- Chọn thương hiệu --</option>

                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ old('brandid', $product->brandid) == $brand->id ? 'selected' : '' }}>
                                {{ $brand->brandname }}
                            </option>
                        @endforeach

                    </select>
                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">
                    <label class="form-label">Giá</label>
                    <input type="number"
                           name="price"
                           class="form-control"
                           value="{{ old('price', $product->price) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá khuyến mãi</label>
                    <input type="number"
                           name="pricediscount"
                           class="form-control"
                           value="{{ old('pricediscount', $product->pricediscount) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ảnh sản phẩm</label>

                    @if($product->image)
                        <div class="mb-2">
                            <img src="{{ asset('images/products/'.$product->image) }}"
                                 width="120"
                                 class="img-thumbnail">
                        </div>
                    @endif

                    <input type="file"
                           name="image"
                           class="form-control"
                           accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Trạng thái</label>

                    <input type="radio"
                           class="btn-check"
                           name="status"
                           id="active"
                           value="1"
                           {{ old('status', $product->status) == 1 ? 'checked' : '' }}>

                    <label class="btn btn-outline-success" for="active">
                        Hiển thị
                    </label>

                    <input type="radio"
                           class="btn-check"
                           name="status"
                           id="inactive"
                           value="0"
                           {{ old('status', $product->status) == 0 ? 'checked' : '' }}>

                    <label class="btn btn-outline-danger" for="inactive">
                        Ẩn
                    </label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả sản phẩm</label>
                    <textarea name="description"
                              rows="4"
                              class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary">
            Lưu sản phẩm
        </button>

        <a href="{{ route('admin.products.index') }}"
           class="btn btn-secondary">
            Quay lại
        </a>

    </form>
</div>
@endsection
