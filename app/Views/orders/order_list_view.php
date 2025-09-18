<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>

<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><i class="fas fa-shopping-cart me-2"></i>List of Order</h2>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Order
            </button>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="card mb-4">
        <div class="card-header">
            <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Filters</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <!-- Date Range Filter -->
                <div class="col-md-3">
                    <label class="form-label">Date Range</label>
                    <div class="input-group">
                        <input type="date" class="form-control" placeholder="From">
                        <input type="date" class="form-control" placeholder="To">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select class="form-select">
                        <option value="">All Status</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="booked">Booked</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <!-- Payment Status Filter -->
                <div class="col-md-2">
                    <label class="form-label">Payment Status</label>
                    <select class="form-select">
                        <option value="">All Payments</option>
                        <option value="paid">Fully Paid</option>
                        <option value="partial">Partially Paid</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                </div>

                <!-- Customer Search -->
                <div class="col-md-3">
                    <label class="form-label">Customer</label>
                    <input type="text" class="form-control" placeholder="Search customer name...">
                </div>

                <!-- Actions -->
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-outline-primary me-2">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <button class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> Clear
                    </button>
                </div>
            </div>

            <!-- Additional Filters Row -->
            <div class="row g-3 mt-2">
                <div class="col-md-2">
                    <label class="form-label">Payment Method</label>
                    <select class="form-select">
                        <option value="">All Methods</option>
                        <option value="cash">Cash</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="card">Card</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Amount Range</label>
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Min" step="0.01">
                        <input type="number" class="form-control" placeholder="Max" step="0.01">
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Records per page</label>
                    <select class="form-select">
                        <option value="10">10</option>
                        <option value="25" selected>25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div class="col-md-6 d-flex align-items-end justify-content-end">
                    <button class="btn btn-outline-success me-2">
                        <i class="fas fa-download"></i> Export Excel
                    </button>
                    <button class="btn btn-outline-info">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-shopping-cart fa-2x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold text-primary">Total Orders</div>
                            <div class="h4 mb-0">1,234</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-dollar-sign fa-2x text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold text-success">Total Revenue</div>
                            <div class="h4 mb-0">$45,678</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clock fa-2x text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold text-warning">Pending Orders</div>
                            <div class="h4 mb-0">23</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold text-info">Active Customers</div>
                            <div class="h4 mb-0">567</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Orders List</h6>
            <div class="d-flex align-items-center">
                <span class="text-muted me-3">Showing 1-25 of 1,234 orders</span>
                <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-outline-secondary active">
                        <i class="fas fa-table"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-th-large"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input">
                            </th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Items</th>
                            <th>Order Date</th>
                            <th>Scheduled</th>
                            <th>Status</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Payment Method</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Row 1 -->
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td>
                                <strong>#ORD-2024-001</strong>
                                <br><small class="text-muted">Created by: John Admin</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Sarah Johnson</div>
                                        <small class="text-muted">sarah@email.com</small>
                                        <br><small class="text-muted">+61 412 345 678</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span class="badge bg-light text-dark">3 items</span>
                                    <br><small class="text-muted">Hair Cut, Wash, Style</small>
                                </div>
                            </td>
                            <td>
                                <div>2024-09-18</div>
                                <small class="text-muted">10:30 AM</small>
                            </td>
                            <td>
                                <div>2024-09-20</div>
                                <small class="text-muted">2:00 PM</small>
                            </td>
                            <td>
                                <span class="badge bg-success">Completed</span>
                            </td>
                            <td>
                                <div class="fw-bold">$85.00</div>
                            </td>
                            <td>
                                <span class="badge bg-success">
                                    <i class="fas fa-check me-1"></i>Fully Paid
                                </span>
                                <br><small class="text-muted">Paid: $85.00</small>
                            </td>
                            <td>
                                <span class="badge bg-primary">Card</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Invoice</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i>Send Email</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-copy me-2"></i>Duplicate</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Row 2 -->
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td>
                                <strong>#ORD-2024-002</strong>
                                <br><small class="text-muted">Created by: Jane Admin</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Michael Brown</div>
                                        <small class="text-muted">mike@business.com</small>
                                        <br><small class="text-muted">+61 423 567 890</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span class="badge bg-light text-dark">2 items</span>
                                    <br><small class="text-muted">Massage, Facial</small>
                                </div>
                            </td>
                            <td>
                                <div>2024-09-18</div>
                                <small class="text-muted">11:15 AM</small>
                            </td>
                            <td>
                                <div>2024-09-19</div>
                                <small class="text-muted">3:30 PM</small>
                            </td>
                            <td>
                                <span class="badge bg-warning">Booked</span>
                            </td>
                            <td>
                                <div class="fw-bold">$120.00</div>
                            </td>
                            <td>
                                <span class="badge bg-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Partial
                                </span>
                                <br><small class="text-muted">Paid: $50.00</small>
                            </td>
                            <td>
                                <span class="badge bg-info">Bank Transfer</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Invoice</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i>Send Email</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-copy me-2"></i>Duplicate</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Sample Row 3 -->
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td>
                                <strong>#ORD-2024-003</strong>
                                <br><small class="text-muted">Created by: Admin User</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Emily Davis</div>
                                        <small class="text-muted">emily@gmail.com</small>
                                        <br><small class="text-muted">+61 434 789 012</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <span class="badge bg-light text-dark">1 item</span>
                                    <br><small class="text-muted">Consultation</small>
                                </div>
                            </td>
                            <td>
                                <div>2024-09-17</div>
                                <small class="text-muted">9:00 AM</small>
                            </td>
                            <td>
                                <div>-</div>
                                <small class="text-muted">Not scheduled</small>
                            </td>
                            <td>
                                <span class="badge bg-primary">Confirmed</span>
                            </td>
                            <td>
                                <div class="fw-bold">$45.00</div>
                            </td>
                            <td>
                                <span class="badge bg-danger">
                                    <i class="fas fa-times me-1"></i>Unpaid
                                </span>
                                <br><small class="text-muted">Paid: $0.00</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary">-</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-primary" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Invoice</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i>Send Email</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-copy me-2"></i>Duplicate</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="card-footer">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="text-muted">
                        Showing <strong>1</strong> to <strong>25</strong> of <strong>1,234</strong> orders
                    </div>
                </div>
                <div class="col-md-6">
                    <nav>
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">...</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">50</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Actions (Hidden by default, shown when checkboxes are selected) -->
    <div class="card mt-3" id="bulkActions" style="display: none;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <strong>3 orders selected</strong>
                </div>
                <div class="btn-group" role="group">
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-edit me-2"></i>Bulk Edit Status
                    </button>
                    <button class="btn btn-outline-success">
                        <i class="fas fa-envelope me-2"></i>Send Notifications
                    </button>
                    <button class="btn btn-outline-info">
                        <i class="fas fa-download me-2"></i>Export Selected
                    </button>
                    <button class="btn btn-outline-danger">
                        <i class="fas fa-trash me-2"></i>Delete Selected
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Litepicker({
            element: document.getElementById('litepicker'),
            singleMode: false, // aktifkan range
            format: 'YYYY-MM-DD'
        });
    });
</script>
<?php include_once __DIR__ . '/../footer_view.php'; ?>