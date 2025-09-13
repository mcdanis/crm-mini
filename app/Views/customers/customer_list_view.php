<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2>Customer List</h2>
            <button class="btn btn-c-primary">Add Customer</button>
        </div>
    </div>

    <div class="dashboard-section">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Source</th>
                        <th>Tag</th>
                        <th>Joined Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Dani Pratama</td>
                        <td>dani@mail.com</td>
                        <td>+62 812 3456 7890</td>
                        <td>CRM Solutions</td>
                        <td>Instagram</td>
                        <td>VIP</td>
                        <td>2025-09-13</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-fill"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Rina Saputra</td>
                        <td>rina@mail.com</td>
                        <td>+62 813 5678 1234</td>
                        <td>Marketing Pro</td>
                        <td>Referral</td>
                        <td>Regular</td>
                        <td>2025-09-10</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-fill"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                    <!-- Tambahkan data lainnya di sini -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>



<?php include_once __DIR__ . '/../footer_view.php'; ?>