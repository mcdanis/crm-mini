<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRM Reports Dashboard</title>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
        rel="stylesheet" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        rel="stylesheet" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.css"
        rel="stylesheet" />
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #8b5cf6;
            --success-color: #10b981;
            --info-color: #06b6d4;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            height: calc(100vh - 2rem);
            position: sticky;
            top: 1rem;
        }

        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            min-height: calc(100vh - 2rem);
        }

        .nav-link {
            color: var(--dark-color);
            border-radius: 10px;
            margin: 2px 0;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: linear-gradient(45deg,
                    var(--primary-color),
                    var(--secondary-color));
            color: white;
            transform: translateX(5px);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .stat-card {
            background: linear-gradient(45deg,
                    var(--primary-color),
                    var(--secondary-color));
            color: white;
        }

        .stat-card-success {
            background: linear-gradient(45deg, var(--success-color), #34d399);
        }

        .stat-card-info {
            background: linear-gradient(45deg, var(--info-color), #38bdf8);
        }

        .stat-card-warning {
            background: linear-gradient(45deg, var(--warning-color), #fbbf24);
        }

        .report-section {
            display: none;
        }

        .report-section.active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-custom {
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
        }

        .table th {
            border: none;
            background: linear-gradient(45deg,
                    var(--primary-color),
                    var(--secondary-color));
            color: white;
            font-weight: 600;
        }

        .chart-container {
            position: relative;
            height: 400px;
            margin: 20px 0;
        }

        .filter-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-3">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar p-4">
                    <div class="text-center mb-4">
                        <h4 class="fw-bold text-primary">
                            <i class="fas fa-chart-bar me-2"></i>CRM Reports
                        </h4>
                    </div>

                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                href="#"
                                onclick="showSection('overview')">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('customers')">
                                <i class="fas fa-users me-2"></i>Customer Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('sales')">
                                <i class="fas fa-chart-line me-2"></i>Sales Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('payments')">
                                <i class="fas fa-credit-card me-2"></i>Payment Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="#"
                                onclick="showSection('activities')">
                                <i class="fas fa-tasks me-2"></i>Activity Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('services')">
                                <i class="fas fa-cogs me-2"></i>Service Reports
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="#"
                                onclick="showSection('operational')">
                                <i class="fas fa-tools me-2"></i>Operational Reports
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="main-content p-4">
                    <!-- Dashboard Overview -->
                    <div id="overview" class="report-section active">
                        <h2 class="mb-4 fw-bold">
                            <i class="fas fa-tachometer-alt me-2 text-primary"></i>Dashboard
                            Overview
                        </h2>

                        <!-- KPI Cards -->
                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="card stat-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-users fa-2x mb-2"></i>
                                        <h3 class="fw-bold">1,247</h3>
                                        <p class="mb-0">Total Customers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="card stat-card-success">
                                    <div class="card-body text-center">
                                        <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                                        <h3 class="fw-bold">3,892</h3>
                                        <p class="mb-0">Total Orders</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="card stat-card-info">
                                    <div class="card-body text-center">
                                        <i class="fas fa-dollar-sign fa-2x mb-2"></i>
                                        <h3 class="fw-bold">$284K</h3>
                                        <p class="mb-0">Total Revenue</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="card stat-card-warning">
                                    <div class="card-body text-center">
                                        <i class="fas fa-chart-line fa-2x mb-2"></i>
                                        <h3 class="fw-bold">23%</h3>
                                        <p class="mb-0">Growth Rate</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Charts -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-chart-area me-2"></i>Revenue Trend
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="revenueChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-chart-pie me-2"></i>Order Status
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="statusChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Reports -->
                    <div id="customers" class="report-section">
                        <h2 class="mb-4 fw-bold">
                            <i class="fas fa-users me-2 text-primary"></i>Customer Reports
                        </h2>

                        <!-- Filters -->
                        <div class="filter-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Date Range</label>
                                    <select class="form-select">
                                        <option>Last 30 days</option>
                                        <option>Last 3 months</option>
                                        <option>Last 6 months</option>
                                        <option>Custom</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Customer Source</label>
                                    <select class="form-select">
                                        <option>All Sources</option>
                                        <option>Instagram</option>
                                        <option>Referral</option>
                                        <option>Google</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Customer Tag</label>
                                    <select class="form-select">
                                        <option>All Tags</option>
                                        <option>VIP</option>
                                        <option>Regular</option>
                                        <option>New</option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button class="btn btn-primary btn-custom w-100">
                                        <i class="fas fa-filter me-2"></i>Apply Filter
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Customer Analytics -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0">Customer Acquisition</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="acquisitionChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-warning text-white">
                                        <h5 class="mb-0">Customer Lifetime Value</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="clvChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Top Customers Table -->
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Top Customers by Revenue</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Email</th>
                                                <th>Total Orders</th>
                                                <th>Total Spent</th>
                                                <th>Last Order</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>John Doe</strong></td>
                                                <td>john@example.com</td>
                                                <td><span class="badge bg-primary">15</span></td>
                                                <td><strong>$12,450</strong></td>
                                                <td>2024-09-10</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jane Smith</strong></td>
                                                <td>jane@example.com</td>
                                                <td><span class="badge bg-primary">12</span></td>
                                                <td><strong>$9,800</strong></td>
                                                <td>2024-09-08</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>PT Maju Jaya</strong></td>
                                                <td>info@majujaya.com</td>
                                                <td><span class="badge bg-primary">8</span></td>
                                                <td><strong>$15,600</strong></td>
                                                <td>2024-09-12</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sales Reports -->
                    <div id="sales" class="report-section">
                        <h2 class="mb-4 fw-bold">
                            <i class="fas fa-chart-line me-2 text-primary"></i>Sales Reports
                        </h2>

                        <!-- Sales KPIs -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card stat-card-success">
                                    <div class="card-body text-center">
                                        <i class="fas fa-dollar-sign fa-2x mb-2"></i>
                                        <h4 class="fw-bold">$45,280</h4>
                                        <p class="mb-0">This Month</p>
                                        <small>+12% vs last month</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card-info">
                                    <div class="card-body text-center">
                                        <i class="fas fa-shopping-bag fa-2x mb-2"></i>
                                        <h4 class="fw-bold">392</h4>
                                        <p class="mb-0">Orders This Month</p>
                                        <small>+8% vs last month</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card-warning">
                                    <div class="card-body text-center">
                                        <i class="fas fa-calculator fa-2x mb-2"></i>
                                        <h4 class="fw-bold">$115</h4>
                                        <p class="mb-0">Avg Order Value</p>
                                        <small>+5% vs last month</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-percentage fa-2x mb-2"></i>
                                        <h4 class="fw-bold">87%</h4>
                                        <p class="mb-0">Completion Rate</p>
                                        <small>+2% vs last month</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sales Charts -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">Monthly Sales Trend</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="salesTrendChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0">Sales by Status</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="salesStatusChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Reports -->
                    <div id="payments" class="report-section">
                        <h2 class="mb-4 fw-bold">
                            <i class="fas fa-credit-card me-2 text-primary"></i>Payment
                            Reports
                        </h2>

                        <!-- Payment Summary -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card stat-card-success">
                                    <div class="card-body text-center">
                                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                                        <h4 class="fw-bold">$198,450</h4>
                                        <p class="mb-0">Total Received</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card stat-card-warning">
                                    <div class="card-body text-center">
                                        <i class="fas fa-clock fa-2x mb-2"></i>
                                        <h4 class="fw-bold">$28,750</h4>
                                        <p class="mb-0">Pending Payments</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card stat-card-info">
                                    <div class="card-body text-center">
                                        <i class="fas fa-chart-pie fa-2x mb-2"></i>
                                        <h4 class="fw-bold">87.4%</h4>
                                        <p class="mb-0">Collection Rate</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Methods Chart -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">Payment Methods</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="paymentMethodChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">Payment Timeline</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="paymentTimelineChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Payments Table -->
                        <div class="card mt-4">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Recent Payments</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Customer</th>
                                                <th>Order ID</th>
                                                <th>Amount</th>
                                                <th>Method</th>
                                                <th>Reference</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2024-09-13</td>
                                                <td>John Doe</td>
                                                <td>#ORD-001234</td>
                                                <td><strong>$850.00</strong></td>
                                                <td>
                                                    <span class="badge bg-primary">Bank Transfer</span>
                                                </td>
                                                <td>TXN-789456</td>
                                            </tr>
                                            <tr>
                                                <td>2024-09-12</td>
                                                <td>Jane Smith</td>
                                                <td>#ORD-001233</td>
                                                <td><strong>$420.00</strong></td>
                                                <td>
                                                    <span class="badge bg-success">Credit Card</span>
                                                </td>
                                                <td>CC-123789</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Reports -->
                    <div id="activities" class="report-section">
                        <h2 class="mb-4 fw-bold">
                            <i class="fas fa-tasks me-2 text-primary"></i>Activity Reports
                        </h2>

                        <!-- Activity Summary -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card stat-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-phone fa-2x mb-2"></i>
                                        <h4 class="fw-bold">247</h4>
                                        <p class="mb-0">Phone Calls</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card-info">
                                    <div class="card-body text-center">
                                        <i class="fas fa-envelope fa-2x mb-2"></i>
                                        <h4 class="fw-bold">189</h4>
                                        <p class="mb-0">Emails</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card-success">
                                    <div class="card-body text-center">
                                        <i class="fas fa-comments fa-2x mb-2"></i>
                                        <h4 class="fw-bold">156</h4>
                                        <p class="mb-0">Chats</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card-warning">
                                    <div class="card-body text-center">
                                        <i class="fas fa-calendar fa-2x mb-2"></i>
                                        <h4 class="fw-bold">73</h4>
                                        <p class="mb-0">Meetings</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Activity Charts -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">Activity Timeline</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="activityTimelineChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="mb-0">Activity Distribution</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="activityDistributionChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Reports -->
                    <div id="services" class="report-section">
                        <h2 class="mb-4 fw-bold">
                            <i class="fas fa-cogs me-2 text-primary"></i>Service Reports
                        </h2>

                        <!-- Service Performance -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card stat-card-success">
                                    <div class="card-body text-center">
                                        <i class="fas fa-star fa-2x mb-2"></i>
                                        <h4 class="fw-bold">12</h4>
                                        <p class="mb-0">Active Services</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card stat-card-info">
                                    <div class="card-body text-center">
                                        <i class="fas fa-trophy fa-2x mb-2"></i>
                                        <h4 class="fw-bold">Web Design</h4>
                                        <p class="mb-0">Top Service</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card stat-card-warning">
                                    <div class="card-body text-center">
                                        <i class="fas fa-dollar-sign fa-2x mb-2"></i>
                                        <h4 class="fw-bold">$2,450</h4>
                                        <p class="mb-0">Avg Service Value</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Performance Charts -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">Top Services by Revenue</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="serviceRevenueChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">Service Demand Trend</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="serviceDemandChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service Performance Table -->
                        <div class="card mt-4">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Service Performance Analysis</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Service Name</th>
                                                <th>Orders Count</th>
                                                <th>Total Revenue</th>
                                                <th>Avg Price</th>
                                                <th>Growth</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Web Design</strong></td>
                                                <td>156</td>
                                                <td><strong>$234,500</strong></td>
                                                <td>$1,503</td>
                                                <td><span class="badge bg-success">+15%</span></td>
                                                <td><span class="badge bg-success">Active</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Mobile App Development</strong></td>
                                                <td>89</td>
                                                <td><strong>$445,600</strong></td>
                                                <td>$5,007</td>
                                                <td><span class="badge bg-success">+22%</span></td>
                                                <td><span class="badge bg-success">Active</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Digital Marketing</strong></td>
                                                <td>203</td>
                                                <td><strong>$152,400</strong></td>
                                                <td>$751</td>
                                                <td><span class="badge bg-warning">+5%</span></td>
                                                <td><span class="badge bg-success">Active</span></td>
                                            </tr>
                                            <tr>
                                                <td><strong>SEO Optimization</strong></td>
                                                <td>134</td>
                                                <td><strong>$67,800</strong></td>
                                                <td>$506</td>
                                                <td><span class="badge bg-danger">-3%</span></td>
                                                <td><span class="badge bg-warning">Review</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Operational Reports -->
                    <div id="operational" class="report-section">
                        <h2 class="mb-4 fw-bold">
                            <i class="fas fa-tools me-2 text-primary"></i>Operational
                            Reports
                        </h2>

                        <!-- Operational KPIs -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card stat-card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-upload fa-2x mb-2"></i>
                                        <h4 class="fw-bold">47</h4>
                                        <p class="mb-0">Import Jobs</p>
                                        <small>This month</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card-success">
                                    <div class="card-body text-center">
                                        <i class="fas fa-download fa-2x mb-2"></i>
                                        <h4 class="fw-bold">23</h4>
                                        <p class="mb-0">Export Jobs</p>
                                        <small>This month</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card-info">
                                    <div class="card-body text-center">
                                        <i class="fas fa-lightbulb fa-2x mb-2"></i>
                                        <h4 class="fw-bold">284</h4>
                                        <p class="mb-0">Recommendations</p>
                                        <small>Generated</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card stat-card-warning">
                                    <div class="card-body text-center">
                                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                                        <h4 class="fw-bold">67%</h4>
                                        <p class="mb-0">Action Rate</p>
                                        <small>On recommendations</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Import/Export Jobs -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">Recent Import/Export Jobs</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Type</th>
                                                        <th>Status</th>
                                                        <th>Progress</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-primary">Import</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-success">Completed</span>
                                                        </td>
                                                        <td>1,250/1,250</td>
                                                        <td>2024-09-13</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span class="badge bg-info">Export</span></td>
                                                        <td>
                                                            <span class="badge bg-warning">Processing</span>
                                                        </td>
                                                        <td>780/950</td>
                                                        <td>2024-09-13</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-primary">Import</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-success">Completed</span>
                                                        </td>
                                                        <td>450/450</td>
                                                        <td>2024-09-12</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">Job Success Rate</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-container">
                                            <canvas id="jobSuccessChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recommendations -->
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Top Customer Recommendations</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Customer</th>
                                                <th>Recommendation</th>
                                                <th>Score</th>
                                                <th>Created</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>John Doe</strong></td>
                                                <td>Follow up on mobile app project proposal</td>
                                                <td><span class="badge bg-success">9.2</span></td>
                                                <td>2024-09-12</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary">Act</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jane Smith</strong></td>
                                                <td>Upsell SEO services based on web redesign</td>
                                                <td><span class="badge bg-info">8.7</span></td>
                                                <td>2024-09-11</td>
                                                <td>
                                                    <span class="badge bg-success">Completed</span>
                                                </td>
                                                <td>
                                                    <button
                                                        class="btn btn-sm btn-outline-secondary"
                                                        disabled>
                                                        Done
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>PT Maju Jaya</strong></td>
                                                <td>Schedule quarterly business review</td>
                                                <td><span class="badge bg-primary">8.1</span></td>
                                                <td>2024-09-10</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary">Act</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Navigation functionality
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll(".report-section").forEach((section) => {
                section.classList.remove("active");
            });

            // Remove active class from all nav links
            document.querySelectorAll(".nav-link").forEach((link) => {
                link.classList.remove("active");
            });

            // Show selected section
            document.getElementById(sectionId).classList.add("active");

            // Add active class to clicked nav link
            event.target.classList.add("active");
        }

        // Chart configurations
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "bottom",
                },
            },
        };

        // Revenue Chart
        const revenueCtx = document.getElementById("revenueChart");
        if (revenueCtx) {
            new Chart(revenueCtx, {
                type: "line",
                data: {
                    labels: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                    ],
                    datasets: [{
                        label: "Revenue",
                        data: [
                            12000, 15000, 18000, 16000, 22000, 25000, 28000, 24000, 30000,
                        ],
                        borderColor: "#6366f1",
                        backgroundColor: "rgba(99, 102, 241, 0.1)",
                        tension: 0.4,
                        fill: true,
                    }, ],
                },
                options: chartOptions,
            });
        }

        // Status Chart
        const statusCtx = document.getElementById("statusChart");
        if (statusCtx) {
            new Chart(statusCtx, {
                type: "doughnut",
                data: {
                    labels: ["Completed", "In Progress", "Draft", "Cancelled"],
                    datasets: [{
                        data: [45, 25, 20, 10],
                        backgroundColor: ["#10b981", "#f59e0b", "#6b7280", "#ef4444"],
                    }, ],
                },
                options: chartOptions,
            });
        }

        // Customer Acquisition Chart
        const acquisitionCtx = document.getElementById("acquisitionChart");
        if (acquisitionCtx) {
            new Chart(acquisitionCtx, {
                type: "bar",
                data: {
                    labels: ["Instagram", "Referral", "Google", "Direct", "Facebook"],
                    datasets: [{
                        label: "New Customers",
                        data: [45, 32, 28, 25, 18],
                        backgroundColor: [
                            "#e91e63",
                            "#9c27b0",
                            "#4caf50",
                            "#2196f3",
                            "#ff9800",
                        ],
                    }, ],
                },
                options: chartOptions,
            });
        }

        // CLV Chart
        const clvCtx = document.getElementById("clvChart");
        if (clvCtx) {
            new Chart(clvCtx, {
                type: "line",
                data: {
                    labels: ["Q1", "Q2", "Q3", "Q4"],
                    datasets: [{
                        label: "Average CLV",
                        data: [1200, 1350, 1480, 1620],
                        borderColor: "#f59e0b",
                        backgroundColor: "rgba(245, 158, 11, 0.1)",
                        tension: 0.4,
                        fill: true,
                    }, ],
                },
                options: chartOptions,
            });
        }

        // Sales Trend Chart
        const salesTrendCtx = document.getElementById("salesTrendChart");
        if (salesTrendCtx) {
            new Chart(salesTrendCtx, {
                type: "line",
                data: {
                    labels: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                    ],
                    datasets: [{
                            label: "Orders",
                            data: [120, 150, 180, 160, 220, 250, 280, 240, 300],
                            borderColor: "#10b981",
                            backgroundColor: "rgba(16, 185, 129, 0.1)",
                            yAxisID: "y",
                        },
                        {
                            label: "Revenue ($)",
                            data: [
                                12000, 15000, 18000, 16000, 22000, 25000, 28000, 24000, 30000,
                            ],
                            borderColor: "#6366f1",
                            backgroundColor: "rgba(99, 102, 241, 0.1)",
                            yAxisID: "y1",
                        },
                    ],
                },
                options: {
                    ...chartOptions,
                    scales: {
                        y: {
                            type: "linear",
                            display: true,
                            position: "left",
                        },
                        y1: {
                            type: "linear",
                            display: true,
                            position: "right",
                            grid: {
                                drawOnChartArea: false,
                            },
                        },
                    },
                },
            });
        }

        // Sales Status Chart
        const salesStatusCtx = document.getElementById("salesStatusChart");
        if (salesStatusCtx) {
            new Chart(salesStatusCtx, {
                type: "pie",
                data: {
                    labels: ["Completed", "In Progress", "Confirmed", "Draft"],
                    datasets: [{
                        data: [50, 25, 15, 10],
                        backgroundColor: ["#10b981", "#f59e0b", "#06b6d4", "#6b7280"],
                    }, ],
                },
                options: chartOptions,
            });
        }

        // Payment Method Chart
        const paymentMethodCtx = document.getElementById("paymentMethodChart");
        if (paymentMethodCtx) {
            new Chart(paymentMethodCtx, {
                type: "doughnut",
                data: {
                    labels: ["Bank Transfer", "Credit Card", "Cash", "Digital Wallet"],
                    datasets: [{
                        data: [45, 30, 15, 10],
                        backgroundColor: ["#6366f1", "#10b981", "#f59e0b", "#8b5cf6"],
                    }, ],
                },
                options: chartOptions,
            });
        }

        // Payment Timeline Chart
        const paymentTimelineCtx = document.getElementById(
            "paymentTimelineChart"
        );
        if (paymentTimelineCtx) {
            new Chart(paymentTimelineCtx, {
                type: "bar",
                data: {
                    labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
                    datasets: [{
                        label: "Payments Received",
                        data: [45000, 38000, 52000, 48000],
                        backgroundColor: "#10b981",
                    }, ],
                },
                options: chartOptions,
            });
        }

        // Activity Timeline Chart
        const activityTimelineCtx = document.getElementById(
            "activityTimelineChart"
        );
        if (activityTimelineCtx) {
            new Chart(activityTimelineCtx, {
                type: "line",
                data: {
                    labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                    datasets: [{
                            label: "Calls",
                            data: [12, 18, 15, 22, 25, 8, 5],
                            borderColor: "#6366f1",
                            backgroundColor: "rgba(99, 102, 241, 0.1)",
                        },
                        {
                            label: "Emails",
                            data: [8, 12, 10, 15, 18, 6, 3],
                            borderColor: "#10b981",
                            backgroundColor: "rgba(16, 185, 129, 0.1)",
                        },
                        {
                            label: "Meetings",
                            data: [3, 5, 4, 7, 8, 2, 1],
                            borderColor: "#f59e0b",
                            backgroundColor: "rgba(245, 158, 11, 0.1)",
                        },
                    ],
                },
                options: chartOptions,
            });
        }

        // Activity Distribution Chart
        const activityDistributionCtx = document.getElementById(
            "activityDistributionChart"
        );
        if (activityDistributionCtx) {
            new Chart(activityDistributionCtx, {
                type: "doughnut",
                data: {
                    labels: ["Calls", "Emails", "Chats", "Meetings", "Notes"],
                    datasets: [{
                        data: [35, 25, 20, 12, 8],
                        backgroundColor: [
                            "#6366f1",
                            "#10b981",
                            "#f59e0b",
                            "#8b5cf6",
                            "#06b6d4",
                        ],
                    }, ],
                },
                options: chartOptions,
            });
        }

        // Service Revenue Chart
        const serviceRevenueCtx = document.getElementById("serviceRevenueChart");
        if (serviceRevenueCtx) {
            new Chart(serviceRevenueCtx, {
                type: "bar",
                data: {
                    labels: [
                        "Web Design",
                        "Mobile App",
                        "Digital Marketing",
                        "SEO",
                        "Consulting",
                    ],
                    datasets: [{
                        label: "Revenue ($)",
                        data: [234500, 445600, 152400, 67800, 89200],
                        backgroundColor: [
                            "#6366f1",
                            "#10b981",
                            "#f59e0b",
                            "#8b5cf6",
                            "#06b6d4",
                        ],
                    }, ],
                },
                options: {
                    ...chartOptions,
                    indexAxis: "y",
                },
            });
        }

        // Service Demand Chart
        const serviceDemandCtx = document.getElementById("serviceDemandChart");
        if (serviceDemandCtx) {
            new Chart(serviceDemandCtx, {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                    datasets: [{
                            label: "Web Design",
                            data: [15, 18, 22, 25, 28, 32],
                            borderColor: "#6366f1",
                            backgroundColor: "rgba(99, 102, 241, 0.1)",
                        },
                        {
                            label: "Mobile App",
                            data: [8, 12, 15, 18, 20, 22],
                            borderColor: "#10b981",
                            backgroundColor: "rgba(16, 185, 129, 0.1)",
                        },
                        {
                            label: "Digital Marketing",
                            data: [25, 28, 30, 35, 38, 40],
                            borderColor: "#f59e0b",
                            backgroundColor: "rgba(245, 158, 11, 0.1)",
                        },
                    ],
                },
                options: chartOptions,
            });
        }

        // Job Success Chart
        const jobSuccessCtx = document.getElementById("jobSuccessChart");
        if (jobSuccessCtx) {
            new Chart(jobSuccessCtx, {
                type: "doughnut",
                data: {
                    labels: ["Completed", "Processing", "Failed"],
                    datasets: [{
                        data: [85, 10, 5],
                        backgroundColor: ["#10b981", "#f59e0b", "#ef4444"],
                    }, ],
                },
                options: chartOptions,
            });
        }

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>

</html>