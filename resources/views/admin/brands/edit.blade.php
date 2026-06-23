@extends('admin.layouts.admin')

@section('title', 'Sửa thương hiệu')

@section('content')
<div class="border rounded bg-white p-4 shadow-sm">
    <h3 class="mb-4">Sửa thương hiệu</h3>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.brands.update', $brand->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Tên thương hiệu</label>
                    <input type="text" name="brandname" class="form-control"
                           value="{{ old('brandname', $brand->brandname) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control"
                           value="{{ old('slug', $brand->slug) }}" required>
                </div>

                <!-- <div class="mb-3">
                    <label class="form-label">Thứ tự hiển thị</label>
                    <input type="number" name="sort_order" class="form-control"
                           value="{{ old('sort_order', $brand->sort_order) }}">
                </div> -->
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Ảnh thương hiệu</label>

                    @if($brand->image)
                        <div class="mb-2">
                            <img src="{{ asset('images/brands/' . $brand->image) }}"
                                 width="120"
                                 class="img-thumbnail">
                        </div>
                    @endif

                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Trạng thái</label>
                    <input type="radio" class="btn-check" name="status" id="active" value="1"
                           {{ old('status', $brand->status) == 1 ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="active">Hiển thị</label>

                    <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                           {{ old('status', $brand->status) == 0 ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="inactive">Ẩn</label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $brand->description) }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Lưu thương hiệu</button>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
