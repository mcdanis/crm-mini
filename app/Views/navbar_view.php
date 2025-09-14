<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #373B44 0%, #4286f4 100%);">
    <div class="container-fluid px-md-5 px-sm-3">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center fw-bold text-white" href="#" style="font-size: 1.25rem;">
            <!-- Contoh logo SVG simpel -->
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="me-2" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 0 8 8A8 8 0 0 0 8 0Zm3 12H5a.5.5 0 0 1 0-1h6a.5.5 0 0 1 0 1Z" />
            </svg>
            CRMv1
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Menu Kiri -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-lg-3 gap-2 align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link active text-white fw-semibold" href="/dashboard" style="position: relative;">
                        Dashboard
                        <span class="position-absolute bottom-0 start-0 end-0 mx-auto" style="height: 3px; width: 40%; background: #FFD54F; border-radius: 5px;"></span>
                    </a>
                </li>

                <!-- Customer Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="customerDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-people-fill me-1"></i> Customer
                    </a>
                    <ul class="dropdown-menu shadow border-0" aria-labelledby="customerDropdown">
                        <li><a class="dropdown-item" href="/customer/add">Add</a></li>
                        <li><a class="dropdown-item" href="/customer/list">List</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Import/Export</a></li>
                    </ul>
                </li>

                <!-- Order Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" id="orderDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bag-fill me-1"></i> Order
                    </a>
                    <ul class="dropdown-menu shadow border-0" aria-labelledby="orderDropdown">
                        <li><a class="dropdown-item" href="/order/add">New Order</a></li>
                        <li><a class="dropdown-item" href="/order/list">List Orders</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Import/Export</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="/service/list">
                        <i class="bi bi-wrench"></i> Service
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white fw-semibold" href="/report">
                        <i class="bi bi-gear-fill me-1"></i> Report
                    </a>
                </li>
            </ul>

            <!-- Notification & Profile -->
            <ul class="navbar-nav mb-2 mb-lg-0 d-flex flex-row align-items-center gap-3">

                <li class="nav-item dropdown position-relative">
                    <a class="nav-link p-0 position-relative" href="#" id="notifDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.4rem; color: white;">
                        <i class="bi bi-bell-fill"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger shadow-sm" style="font-size: 0.65rem;">
                            3
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2" aria-labelledby="notifDropdown" style="min-width: 280px; max-width: 320px;">
                        <li><a class="dropdown-item d-flex align-items-center gap-2" href="#"><i class="bi bi-envelope-fill text-primary"></i> Pesan baru dari Admin</a></li>
                        <li><a class="dropdown-item d-flex align-items-center gap-2" href="#"><i class="bi bi-check2-circle text-success"></i> Order #123 berhasil</a></li>
                        <li><a class="dropdown-item d-flex align-items-center gap-2" href="#"><i class="bi bi-exclamation-triangle-fill text-warning"></i> Server down 5 menit</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-center text-primary fw-semibold" href="#">Lihat semua</a></li>
                    </ul>
                </li>

                <!-- Profile -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="profileDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                        <img src="https://static.vecteezy.com/system/resources/previews/036/594/092/non_2x/man-empty-avatar-photo-placeholder-for-social-networks-resumes-forums-and-dating-sites-male-and-female-no-photo-images-for-unfilled-user-profile-free-vector.jpg" class="rounded-circle border border-white shadow-sm" alt="Profile" width="34" height="34" />
                        <span class="d-none d-lg-inline fw-semibold">Dani</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="/user/profile"><i class="bi bi-person-circle me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="/settings"><i class="bi bi-gear me-2"></i> Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="/logout"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>