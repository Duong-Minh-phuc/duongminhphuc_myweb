<form action="{{ route('admin.categories.store') }}" method="POST">
@csrf
    <div class="mb-3">
    <label>Tên loại sản phẩm</label>
    <input type="text" name="catename" class="form-control">
    </div>
    <div class="mb-3">
    <label>Slug</label>
    <input type="text" name="slug" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">
        Lưu
    </button>
</form>
