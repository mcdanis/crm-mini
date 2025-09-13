<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>
<div class="container mt-4">
    <h2 class="mb-4">Dashboard</h2>

    <!-- Filter Date -->
    <div class="dashboard-section mb-4">
        <div class="d-flex flex-column flex-md-row justify-content-md-end gap-2 mb-4">
            <input id="litepicker" class="form-control" placeholder="Custom date range" style="max-width: 220px;">
            <button class="btn btn-c-primary btn-sm">Today</button>
            <button class="btn btn-c-primary btn-sm">This Week</button>
            <button class="btn btn-c-primary btn-sm">This Month</button>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card-standard d-flex justify-content-between align-items-center">
                    <div class="text">
                        <h6 class="text-muted mb-1">Total Orders</h6>
                        <h2 class="mb-1">1,248</h2>
                        <span class="text-success small">+12.5% from last period</span>
                    </div>
                    <div class="icon">
                        <i class="bi bi-cart-fill" style="font-size: 40px;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card-standard d-flex justify-content-between align-items-center">
                    <div class="text">
                        <h6 class="text-muted mb-1">Revenue</h6>
                        <h2 class="mb-1">$12,480</h2>
                        <span class="text-success small">+8.2% from last period</span>
                    </div>
                    <div class="icon">
                        <i class="bi bi-currency-dollar" style="font-size: 40px;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card-standard d-flex justify-content-between align-items-center">
                    <div class="text">
                        <h6 class="text-muted mb-1">New Customer</h6>
                        <h2 class="mb-1">320</h2>
                        <span class="text-success small">+15.3% from last period</span>
                    </div>
                    <div class="icon">
                        <i class="bi bi-people-fill" style="font-size: 40px;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card-standard d-flex justify-content-between align-items-center">
                    <div class="text">
                        <h6 class="text-muted mb-1">Customer Retention</h6>
                        <h2 class="mb-1">78%</h2>
                        <span class="text-success small">+5% from last period</span>
                    </div>
                    <div class="icon">
                        <i class="bi bi-arrow-repeat" style="font-size: 40px;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lower Dashboard -->
        <div class="row g-4 mt-4">
            <div class="col-md-6">
                <div class="box mb-4">
                    <h5>OnGoing Service</h5>
                    <p class="text-muted">List of ongoing services will appear here.</p>
                </div>
                <div class="box">
                    <h5>Monthly Revenue</h5>
                    <p class="text-muted">Revenue chart and details.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <h5>Recent Activity</h5>
                    <p class="text-muted">Recent user actions and updates.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Litepicker({
            element: document.getElementById('litepicker'),
            singleMode: false,
            format: 'YYYY-MM-DD'
        });
    });
</script>

<?php include_once __DIR__ . '/../footer_view.php'; ?>