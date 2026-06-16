@extends('admin.layouts.admin')

@section('title', 'Thương hiệu')

@section('content')
<div class="container">
    <h1>Danh sách thương hiệu</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary mb-3">
        Thêm mới
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã thương hiệu</th>
                <th>Tên thương hiệu</th>
                <th>Slug</th>
                <th>Ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($list as $key => $item)
                <tr>
                    <td>{{ $list->firstItem() + $key }}</td>

                    <td>{{ $item->id }}</td>
                    <td>{{ $item->brandname }}</td>
                    <td>{{ $item->slug }}</td>

                    <td>
                        <img
                            src="{{ asset('images/brands/' . ($item->image ?? 'default.png')) }}"
                            width="50"
                            height="50"
                            style="object-fit: cover">
                    </td>

                    <td>
                        @if ($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>

                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.brands.edit', $item->id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i> Sửa
                            </a>

                            <form action="{{ route('admin.brands.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Bạn có chắc muốn xóa thương hiệu này?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Xóa
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $list->onEachSide(1)->links('pagination::bootstrap-5') }}
</div>
@endsection
