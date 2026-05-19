<div class="admin-sidebar bg-dark text-white p-3 vh-100">
    <h4 class="mb-4">
        <i class="bi bi-speedometer2"></i>
        Admin
    </h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('admin.home') }}">
                <i class="bi bi-house-door"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="/admin/dashboard">
                <i class="bi bi-house-door"></i>
                Dashboard**
            </a>
        </li>
        {{-- Menu expand --}}
        <li class="nav-item">
            <a class="nav-link text-white"
               data-bs-toggle="collapse"
               href="#categoryMenu">
                <i class="bi bi-tags"></i>
                Quản lý danh mục
                <i class="bi bi-chevron-down float-end"></i>
            </a>
            <div class="collapse" id="categoryMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            Danh sách loại sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            Thêm loại sản phẩm
                        </a>
                    </li>

                </ul>

            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="#">
                <i class="bi bi-box-seam"></i>
                Sản phẩm
            </a>
        </li>
    </ul>
</div>
