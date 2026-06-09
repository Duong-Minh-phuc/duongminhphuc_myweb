@extends('admin.layouts.admin')

@section('title', 'Sản phẩm')

@section('content')
<div class="container">
    <h1>Danh sách sản phẩm</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
        Thêm mới
    </a>

    <table class="table table-bordered">
<thead>
    <tr>
        <th>STT</th>
        <th>Mã SP</th>
        <th>Tên sản phẩm</th>
        <th>Danh mục</th>
        <th>Thương hiệu</th>
        <th>Giá</th>
        <th>Giá KM</th>
        <th>Ảnh</th>
        <th>Chức năng</th>
    </tr>
</thead>

<tbody>
    @foreach ($list as $key => $item)
        <tr>
            <!-- <td>{{ $key + 1 }}</td> -->
            <td>{{ $list->firstItem() + $key }}</td>
            <td>{{ $item->id }}</td>
            <td>{{ $item->productname }}</td>
            <td>{{ $item->catename }}</td>
            <td>{{ $item->brandname ?? 'Không có' }}</td>
            <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
            <td>{{ number_format($item->pricediscount, 0, ',', '.') }} đ</td>

            <td>
                <img
                    src="{{ asset('images/products/' . ($item->image ?? 'default.png')) }}"
                    alt="{{ $item->productname }}"
                    width="80"
                    height="80"
                    style="object-fit: cover">
            </td>

            <td>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.products.edit', $item->id) }}"
                       class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil-square"></i> Sửa
                    </a>

                    <form action="{{ route('admin.products.destroy', $item->id) }}"
                          method="POST"
                          onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
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
