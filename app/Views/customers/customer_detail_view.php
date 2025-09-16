<?php

use App\Helpers\UtilHelper;

include_once __DIR__ . '/../header_view.php';
?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>
<style>
    .main-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        min-height: calc(100vh - 2rem);
        margin: 1rem;
    }

    /* .customer-header {
        background: linear-gradient(135deg,
                var(--primary-color),
                var(--secondary-color));
        color: white;
        border-radius: 20px 20px 0 0;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    } */

    .customer-header::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(50%, -50%);
    }

    .customer-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: bold;
        margin-right: 1.5rem;
    }

    .nav-tabs .nav-link {
        border: none;
        color: var(--dark-color);
        font-weight: 500;
        padding: 1rem 1.5rem;
        border-radius: 15px 15px 0 0;
        margin-right: 5px;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link.active {
        background: linear-gradient(45deg,
                var(--primary-color),
                var(--secondary-color));
        color: white;
    }

    .nav-tabs .nav-link:hover {
        background: var(--gray-100);
        color: var(--primary-color);
    }

    .tab-content {
        background: white;
        border-radius: 0 0 15px 15px;
        padding: 2rem;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .stat-card {
        background: linear-gradient(45deg,
                var(--primary-color),
                var(--secondary-color));
        color: white;
        text-align: center;
        padding: 1.5rem;
    }

    .stat-card-success {
        background: linear-gradient(45deg, var(--success-color), #34d399);
        color: white;
        text-align: center;
        padding: 1.5rem;
    }

    .stat-card-info {
        background: linear-gradient(45deg, var(--info-color), #38bdf8);
        color: white;
        text-align: center;
        padding: 1.5rem;
    }

    .stat-card-warning {
        background: linear-gradient(45deg, var(--warning-color), #fbbf24);
        color: white;
        text-align: center;
        padding: 1.5rem;
    }

    .activity-timeline {
        position: relative;
        padding-left: 3rem;
    }

    .activity-timeline::before {
        content: "";
        position: absolute;
        left: 20px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--gray-300);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    }

    .timeline-item::before {
        content: "";
        position: absolute;
        left: -41px;
        top: 20px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--primary-color);
        border: 3px solid white;
        box-shadow: 0 0 0 3px var(--primary-color);
    }

    .timeline-item.call::before {
        background: var(--success-color);
        box-shadow: 0 0 0 3px var(--success-color);
    }

    .timeline-item.email::before {
        background: var(--info-color);
        box-shadow: 0 0 0 3px var(--info-color);
    }

    .timeline-item.meeting::before {
        background: var(--warning-color);
        box-shadow: 0 0 0 3px var(--warning-color);
    }

    .timeline-item.note::before {
        background: var(--secondary-color);
        box-shadow: 0 0 0 3px var(--secondary-color);
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
    }

    .activity-icon.call {
        background: var(--success-color);
    }

    .activity-icon.email {
        background: var(--info-color);
    }

    .activity-icon.meeting {
        background: var(--warning-color);
    }

    .activity-icon.note {
        background: var(--secondary-color);
    }

    .activity-icon.chat {
        background: var(--primary-color);
    }

    .btn-custom {
        border-radius: 25px;
        padding: 10px 25px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
    }

    .order-card {
        border-left: 4px solid var(--primary-color);
        transition: all 0.3s ease;
    }

    .order-card:hover {
        border-left-color: var(--secondary-color);
        background: var(--gray-100);
    }

    .order-card.completed {
        border-left-color: var(--success-color);
    }

    .order-card.in_progress {
        border-left-color: var(--warning-color);
    }

    .order-card.cancelled {
        border-left-color: var(--danger-color);
    }

    .customer-tag {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        margin: 0.125rem;
    }

    .tag-vip {
        background: linear-gradient(45deg, #ffd700, #ffed4e);
        color: #92400e;
    }

    .tag-regular {
        background: linear-gradient(45deg, var(--info-color), #38bdf8);
        color: white;
    }

    .tag-new {
        background: linear-gradient(45deg, var(--success-color), #34d399);
        color: white;
    }

    .quick-actions {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 1000;
    }

    .fab-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: none;
        background: linear-gradient(45deg,
                var(--primary-color),
                var(--secondary-color));
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fab-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.4);
        color: white;
    }

    .chart-container {
        position: relative;
        height: 300px;
        margin: 1rem 0;
    }

    @media (max-width: 768px) {
        .customer-header {
            padding: 1.5rem;
        }

        .customer-avatar {
            width: 80px;
            height: 80px;
            font-size: 2rem;
            margin-right: 1rem;
            margin-bottom: 1rem;
        }

        .activity-timeline {
            padding-left: 2rem;
        }

        .timeline-item::before {
            left: -31px;
        }

        .quick-actions {
            bottom: 1rem;
            right: 1rem;
        }

        .fab-btn {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }
    }

    .modal-content {
        border-radius: 15px;
        border: none;
    }

    .modal-header {
        background: linear-gradient(45deg,
                var(--primary-color),
                var(--secondary-color));
        color: white;
        border-radius: 15px 15px 0 0;
    }

    .contact-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .contact-info-item:hover {
        background: var(--gray-100);
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
    }

    .fade-in {
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
</style>
</head>

<body>
    <div class="main-container">
        <!-- Customer Header -->
        <div class="customer-header">
            <div class="d-flex align-items-center mb-3">
                <a href="#" class="text-white me-3" style="font-size: 1.5rem">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div class="customer-avatar"><?= UtilHelper::getInitials($customer->full_name) ?></div>
                <div class="flex-grow-1">
                    <h1 class="h2 mb-2"><?= $customer->full_name ?></h1>
                    <p class="mb-2 opacity-75">
                        <i class="fas fa-envelope me-2"></i><?= $customer->email ?? '-' ?>
                        <span class="mx-3">|</span>
                        <i class="fas fa-phone me-2"></i><?= $customer->phone ?? '-' ?>
                    </p>
                    <div>
                        <span class="customer-tag tag-vip">
                            VIP Customer
                        </span>
                    </div>
                </div>
                <div class="text-end">
                    <div class="mb-2">
                        <small class="opacity-75">Customer Since</small>
                        <div class="h5 mb-0"><?= $customer->created_at ?></div>
                    </div>
                    <div>
                        <small class="opacity-75">Last Contact</small>
                        <div class="h6 mb-0">2 days ago</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="px-4 pt-3">
            <ul class="nav nav-tabs" id="customerTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link active"
                        id="overview-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#overview"
                        type="button"
                        role="tab">
                        <i class="fas fa-chart-pie me-2"></i>Overview
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link"
                        id="orders-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#orders"
                        type="button"
                        role="tab">
                        <i class="fas fa-shopping-cart me-2"></i>Orders
                        <span class="badge bg-primary ms-1">15</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link"
                        id="activities-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#activities"
                        type="button"
                        role="tab">
                        <i class="fas fa-history me-2"></i>Activity Log
                        <span class="badge bg-success ms-1">47</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link"
                        id="profile-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#profile"
                        type="button"
                        role="tab">
                        <i class="fas fa-user me-2"></i>Profile
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="tab-content" id="customerTabContent">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                <!-- KPI Cards -->
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card stat-card">
                            <i class="fas fa-shopping-bag fa-2x mb-2"></i>
                            <h3 class="fw-bold mb-1">15</h3>
                            <p class="mb-0">Total Orders</p>
                            <small class="opacity-75">Since Jan 2023</small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card stat-card-success">
                            <i class="fas fa-dollar-sign fa-2x mb-2"></i>
                            <h3 class="fw-bold mb-1">$12,450</h3>
                            <p class="mb-0">Total Spent</p>
                            <small class="opacity-75">Lifetime value</small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card stat-card-info">
                            <i class="fas fa-calculator fa-2x mb-2"></i>
                            <h3 class="fw-bold mb-1">$830</h3>
                            <p class="mb-0">Avg Order</p>
                            <small class="opacity-75">Per transaction</small>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card stat-card-warning">
                            <i class="fas fa-chart-line fa-2x mb-2"></i>
                            <h3 class="fw-bold mb-1">8.5</h3>
                            <p class="mb-0">CLV Score</p>
                            <small class="opacity-75">High value</small>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-chart-area me-2"></i>Order History Timeline
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="orderTimelineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-header bg-info text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-phone me-2"></i>Contact Summary
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="contact-info-item">
                                    <div
                                        class="contact-icon"
                                        style="background: var(--success-color)">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Phone Calls</div>
                                        <small class="text-muted">18 calls total</small>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <div
                                        class="contact-icon"
                                        style="background: var(--info-color)">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Emails</div>
                                        <small class="text-muted">23 emails sent</small>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <div
                                        class="contact-icon"
                                        style="background: var(--warning-color)">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Meetings</div>
                                        <small class="text-muted">6 meetings held</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Preview -->
                <div class="card mt-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-clock me-2"></i>Recent Activities
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="activity-icon call me-3">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Follow-up call completed</div>
                                        <small class="text-muted">2 days ago • Duration: 15 mins</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="activity-icon email me-3">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Proposal sent via email</div>
                                        <small class="text-muted">3 days ago • Mobile App Project</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="activity-icon meeting me-3">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Project kickoff meeting</div>
                                        <small class="text-muted">1 week ago • 2 hours</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="activity-icon note me-3">
                                        <i class="fas fa-sticky-note"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">Customer feedback noted</div>
                                        <small class="text-muted">1 week ago • Very satisfied</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Tab -->
            <div class="tab-pane fade" id="orders" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Order History</h4>
                    <button
                        class="btn btn-primary btn-custom"
                        data-bs-toggle="modal"
                        data-bs-target="#newOrderModal">
                        <i class="fas fa-plus me-2"></i>New Order
                    </button>
                </div>

                <!-- Order Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option>All Status</option>
                                    <option>Completed</option>
                                    <option>In Progress</option>
                                    <option>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option>All Time</option>
                                    <option>This Month</option>
                                    <option>Last 3 Months</option>
                                    <option>This Year</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input
                                    type="search"
                                    class="form-control"
                                    placeholder="Search orders..." />
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-primary w-100">
                                    <i class="fas fa-filter me-2"></i>Apply Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders List -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card order-card completed">
                            <div class="card-body">
                                <div
                                    class="d-flex justify-content-between align-items-start mb-3">
                                    <h6 class="card-title mb-0">#ORD-001234</h6>
                                    <span class="badge bg-success">Completed</span>
                                </div>
                                <p class="card-text mb-2">
                                    <strong>Website Redesign Project</strong><br />
                                    <small class="text-muted">Complete website overhaul</small>
                                </p>
                                <div
                                    class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-primary mb-0">$2,850</span>
                                    <small class="text-muted">Sep 10, 2024</small>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>Delivered on time
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card order-card in_progress">
                            <div class="card-body">
                                <div
                                    class="d-flex justify-content-between align-items-start mb-3">
                                    <h6 class="card-title mb-0">#ORD-001235</h6>
                                    <span class="badge bg-warning">In Progress</span>
                                </div>
                                <p class="card-text mb-2">
                                    <strong>Mobile App Development</strong><br />
                                    <small class="text-muted">iOS & Android app</small>
                                </p>
                                <div
                                    class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-primary mb-0">$8,500</span>
                                    <small class="text-muted">Sep 5, 2024</small>
                                </div>
                                <div class="mt-2">
                                    <div class="progress" style="height: 5px">
                                        <div
                                            class="progress-bar bg-warning"
                                            role="progressbar"
                                            style="width: 65%"></div>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>65% complete
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card order-card completed">
                            <div class="card-body">
                                <div
                                    class="d-flex justify-content-between align-items-start mb-3">
                                    <h6 class="card-title mb-0">#ORD-001233</h6>
                                    <span class="badge bg-success">Completed</span>
                                </div>
                                <p class="card-text mb-2">
                                    <strong>SEO Optimization</strong><br />
                                    <small class="text-muted">3-month SEO package</small>
                                </p>
                                <div
                                    class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-primary mb-0">$1,200</span>
                                    <small class="text-muted">Aug 15, 2024</small>
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-star me-1"></i>5 star rating
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Load More -->
                <div class="text-center mt-4">
                    <button class="btn btn-outline-primary btn-custom">
                        <i class="fas fa-chevron-down me-2"></i>Load More Orders
                    </button>
                </div>
            </div>

            <!-- Activity Log Tab -->
            <div class="tab-pane fade" id="activities" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Activity Log</h4>
                    <button
                        class="btn btn-primary btn-custom"
                        data-bs-toggle="modal"
                        data-bs-target="#newActivityModal">
                        <i class="fas fa-plus me-2"></i>New Activity
                    </button>
                </div>

                <!-- Activity Filter -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option>All Types</option>
                                    <option>Call</option>
                                    <option>Email</option>
                                    <option>Meeting</option>
                                    <option>Note</option>
                                    <option>Chat</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" placeholder="From" />
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" placeholder="To" />
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-primary w-100">
                                    <i class="fas fa-filter me-2"></i>Apply Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Timeline -->
                <div class="activity-timeline">
                    <div class="timeline-item call fade-in">
                        <div class="d-flex align-items-start">
                            <div class="activity-icon call me-3">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <h6>Follow-up Call</h6>
                                <p class="mb-1">Discussed project updates and next steps.</p>
                                <small class="text-muted">2 days ago • Duration: 15 mins • By: Jane Smith</small>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item email fade-in">
                        <div class="d-flex align-items-start">
                            <div class="activity-icon email me-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h6>Proposal Sent</h6>
                                <p class="mb-1">Sent proposal for mobile app development.</p>
                                <small class="text-muted">3 days ago • By: John Doe</small>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item meeting fade-in">
                        <div class="d-flex align-items-start">
                            <div class="activity-icon meeting me-3">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div>
                                <h6>Project Kickoff Meeting</h6>
                                <p class="mb-1">
                                    Initial meeting to define project scope and milestones.
                                </p>
                                <small class="text-muted">1 week ago • Duration: 2 hours • By: Jane Smith</small>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item note fade-in">
                        <div class="d-flex align-items-start">
                            <div class="activity-icon note me-3">
                                <i class="fas fa-sticky-note"></i>
                            </div>
                            <div>
                                <h6>Customer Feedback</h6>
                                <p class="mb-1">
                                    Noted positive feedback on last deliverable.
                                </p>
                                <small class="text-muted">1 week ago • By: John Doe</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Tab -->
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4">Customer Details</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" value="John Doe" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    value="john.doe@email.com" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    value="+62 812 3456 7890" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Birthday</label>
                                <input type="date" class="form-control" value="1990-01-15" />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" rows="2">
Jl. Sudirman No.12, Jakarta</textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary btn-custom">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Action Buttons -->
    <div class="quick-actions">
        <button
            class="fab-btn"
            data-bs-toggle="modal"
            data-bs-target="#newOrderModal">
            <i class="fas fa-shopping-cart"></i>
        </button>
        <button
            class="fab-btn"
            data-bs-toggle="modal"
            data-bs-target="#newActivityModal">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    <!-- new order -->
    <div
        class="modal fade"
        id="newOrderModal"
        tabindex="-1"
        aria-labelledby="newOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    d
                </div>
                <div class="modal-body">
                    ss
                </div>
            </div>
        </div>
    </div>
    <!-- New Activity Modal -->
    <div
        class="modal fade"
        id="newActivityModal"
        tabindex="-1"
        aria-labelledby="newActivityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newActivityModalLabel">
                        <i class="fas fa-plus me-2"></i>Log New Activity
                    </h5>
                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="activityForm">
                        <div class="mb-3">
                            <label class="form-label">Activity Type</label>
                            <select class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="call">Call</option>
                                <option value="email">Email</option>
                                <option value="meeting">Meeting</option>
                                <option value="note">Note</option>
                                <option value="chat">Chat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Activity title"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Details</label>
                            <textarea
                                class="form-control"
                                rows="4"
                                placeholder="Enter activity details"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date & Time</label>
                            <input type="datetime-local" class="form-control" required />
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-custom">
                                <i class="fas fa-save me-2"></i>Save Activity
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS & dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        // Sample Chart.js code for order timeline
        const ctx = document
            .getElementById("orderTimelineChart")
            .getContext("2d");
        const orderTimelineChart = new Chart(ctx, {
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
                    data: [2, 3, 5, 4, 6, 7, 8, 6, 5],
                    borderColor: "#6366f1",
                    backgroundColor: "rgba(99,102,241,0.2)",
                    tension: 0.3,
                    fill: true,
                    pointRadius: 5,
                }, ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    },
                },
            },
        });
    </script>
</body>

</html>