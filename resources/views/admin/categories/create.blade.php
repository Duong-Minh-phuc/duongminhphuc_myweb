@extends('admin.layouts.admin')

@section('title', 'Thêm loại sản phẩm')

@section('content')
<div class="border rounded bg-white p-4 shadow-sm">
    <h3 class="mb-4">Thêm loại sản phẩm</h3>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Tên loại sản phẩm</label>
                    <input type="text" name="catename" class="form-control"
                           value="{{ old('catename') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control"
                           value="{{ old('slug') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Thứ tự hiển thị</label>
                    <input type="number" name="sort_order" class="form-control"
                           value="{{ old('sort_order', 0) }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Ảnh loại sản phẩm</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Trạng thái</label>
                    <input type="radio" class="btn-check" name="status" id="active" value="1"
                           {{ old('status', 1) == 1 ? 'checked' : '' }}>
                    <label class="btn btn-outline-success" for="active">Hiển thị</label>

                    <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                           {{ old('status') == 0 ? 'checked' : '' }}>
                    <label class="btn btn-outline-danger" for="inactive">Ẩn</label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Lưu loại sản phẩm</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
