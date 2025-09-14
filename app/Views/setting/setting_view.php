<?php

use App\Helpers\HtmlGenerateHelper;

require_once __DIR__ . '/../../../config/constants.php';
include_once __DIR__ . '/../header_view.php';

?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>


<div class="container-fluid p-3">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="sidebar p-4">
                <div class="text-center mb-4">
                    <h4 class="fw-bold text-primary">
                        <i class="fas fa-cogs me-2"></i>Settings
                    </h4>
                </div>

                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            href="#"
                            onclick="showSection('general')">
                            <i class="fas fa-sliders-h me-2"></i>General Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="showSection('users')">
                            <i class="fas fa-users-cog me-2"></i>User Management
                        </a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link" href="#" onclick="showSection('security')">
                            <i class="fas fa-shield-alt me-2"></i>Security
                        </a>
                    </li>
                    <li class="nav-item d-none">
                        <a
                            class="nav-link"
                            href="#"
                            onclick="showSection('notifications')">
                            <i class="fas fa-bell me-2"></i>Notifications
                        </a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link" href="#" onclick="showSection('system')">
                            <i class="fas fa-server me-2"></i>System
                        </a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link" href="#" onclick="showSection('backup')">
                            <i class="fas fa-database me-2"></i>Backup & Restore
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="main-content p-4">
                <div id="result">

                </div>
                <!-- General Settings -->
                <div id="general" class="settings-section active">
                    <h2 class="mb-4 fw-bold">
                        <i class="fas fa-sliders-h me-2 text-primary"></i>General
                        Settings
                    </h2>

                    <!-- Localization Settings -->
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-globe-americas me-2"></i>Localization Settings
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="/api/setting/update" method="POST" id="updateSetting">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Default Language</label>
                                            <select name="language" class="form-select">
                                                <?php foreach (LANGUAGES as $code => $label): ?>
                                                    <option
                                                        <?php
                                                        if ($setting->language == $code) {
                                                            echo 'selected';
                                                        }
                                                        ?>
                                                        value="<?= $code ?>"><?= $label ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Default Currency</label>

                                            <select name="currency" class="form-select">
                                                <?php foreach (CURRENCIES as $code => $data): ?>
                                                    <option
                                                        <?php
                                                        if ($setting->currency == $code) {
                                                            echo 'selected';
                                                        }
                                                        ?>
                                                        value="<?= $code ?>">
                                                        <?= $data['name'] ?> (<?= $code ?>) – <?= $data['symbol'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-c-primary px-5" type="submit">
                                        <?= t('update') ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Application Preferences -->
                    <div class="card d-none">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-cog me-2"></i>Application Preferences
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="setting-item">
                                        <div
                                            class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="setting-icon"
                                                    style="background: var(--success-color)">
                                                    <i class="fas fa-moon"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Dark Mode</h6>
                                                    <small class="text-muted">Enable dark theme</small>
                                                </div>
                                            </div>
                                            <label class="toggle-switch">
                                                <input type="checkbox" />
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="setting-item">
                                        <div
                                            class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="setting-icon"
                                                    style="background: var(--info-color)">
                                                    <i class="fas fa-language"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Auto Detect</h6>
                                                    <small class="text-muted">Language detection</small>
                                                </div>
                                            </div>
                                            <label class="toggle-switch">
                                                <input type="checkbox" checked />
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="setting-item">
                                        <div
                                            class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="setting-icon"
                                                    style="background: var(--warning-color)">
                                                    <i class="fas fa-save"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Auto Save</h6>
                                                    <small class="text-muted">Save changes automatically</small>
                                                </div>
                                            </div>
                                            <label class="toggle-switch">
                                                <input type="checkbox" checked />
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Management -->
                <div id="users" class="settings-section">
                    <div
                        class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0 fw-bold">
                            <i class="fas fa-users-cog me-2 text-primary"></i>User
                            Management
                        </h2>
                        <button
                            class="btn btn-c-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#addUserModal">
                            <i class="fas fa-plus me-2"></i>Add New User
                        </button>
                    </div>

                    <!-- User Stats -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card stat-card">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <h3 class="fw-bold mb-1"><?= $stats->total_users ?></h3>
                                <p class="mb-0">Total Users</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card-success">
                                <i class="fas fa-user-check fa-2x mb-2"></i>
                                <h3 class="fw-bold mb-1"><?= $stats->active_users ?></h3>
                                <p class="mb-0">Active Users</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card-warning">
                                <i class="fas fa-user-shield fa-2x mb-2"></i>
                                <h3 class="fw-bold mb-1"><?= $stats->admin_users ?></h3>
                                <p class="mb-0">Admins</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card-info">
                                <i class="fas fa-user fa-2x mb-2"></i>
                                <h3 class="fw-bold mb-1"><?= $stats->normal_users ?></h3>
                                <p class="mb-0">User</p>
                            </div>
                        </div>
                    </div>

                    <!-- User Filters -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="/api/user/filters" method="POST" id="filterUsers">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select class="form-select" name="role">
                                            <option value="">All Roles</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select" name="status">
                                            <option value="">All Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input
                                            type="search"
                                            class="form-control"
                                            placeholder="Search users..."
                                            name="name" />
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn border btn-outline-primary btn-custom w-100" type="submit">
                                            <i class="fas fa-filter"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-list me-2"></i>User List
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userDatas">
                                        <?php
                                        foreach ($users as $key => $user) {
                                            echo HtmlGenerateHelper::renderUserRow($user);
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div id="security" class="settings-section">
                    <h2 class="mb-4 fw-bold">
                        <i class="fas fa-shield-alt me-2 text-primary"></i>Security
                        Settings
                    </h2>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Password Policy -->
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-key me-2"></i>Password Policy
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Minimum Length</label>
                                        <select class="form-select">
                                            <option>8 characters</option>
                                            <option>10 characters</option>
                                            <option>12 characters</option>
                                        </select>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            checked />
                                        <label class="form-check-label">Require uppercase letters</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            checked />
                                        <label class="form-check-label">Require lowercase letters</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            checked />
                                        <label class="form-check-label">Require numbers</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" />
                                        <label class="form-check-label">Require special characters</label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Password Expiry (days)</label>
                                        <input type="number" class="form-control" value="90" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Session Settings -->
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-clock me-2"></i>Session Settings
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Session Timeout (minutes)</label>
                                        <select class="form-select">
                                            <option>30 minutes</option>
                                            <option>60 minutes</option>
                                            <option>120 minutes</option>
                                            <option>240 minutes</option>
                                        </select>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            checked />
                                        <label class="form-check-label">Remember me option</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            checked />
                                        <label class="form-check-label">Force logout on browser close</label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Max concurrent sessions</label>
                                        <input type="number" class="form-control" value="3" />
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" />
                                        <label class="form-check-label">Enable 2FA for admin users</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifications Settings -->
                <div id="notifications" class="settings-section">
                    <h2 class="mb-4 fw-bold">
                        <i class="fas fa-bell me-2 text-primary"></i>Notification
                        Settings
                    </h2>

                    <div class="row">
                        <div class="col-md-8">
                            <!-- Email Notifications -->
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-envelope me-2"></i>Email Notifications
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="setting-item">
                                                <div
                                                    class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">New Customer</h6>
                                                        <small class="text-muted">When a new customer is added</small>
                                                    </div>
                                                    <label class="toggle-switch">
                                                        <input type="checkbox" checked />
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="setting-item">
                                                <div
                                                    class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">Order Completed</h6>
                                                        <small class="text-muted">When an order is completed</small>
                                                    </div>
                                                    <label class="toggle-switch">
                                                        <input type="checkbox" checked />
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="setting-item">
                                                <div
                                                    class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">Payment Received</h6>
                                                        <small class="text-muted">When a payment is received</small>
                                                    </div>
                                                    <label class="toggle-switch">
                                                        <input type="checkbox" checked />
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="setting-item">
                                                <div
                                                    class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">Weekly Reports</h6>
                                                        <small class="text-muted">Weekly summary reports</small>
                                                    </div>
                                                    <label class="toggle-switch">
                                                        <input type="checkbox" />
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="setting-item">
                                                <div
                                                    class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">System Alerts</h6>
                                                        <small class="text-muted">Important system notifications</small>
                                                    </div>
                                                    <label class="toggle-switch">
                                                        <input type="checkbox" checked />
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="setting-item">
                                                <div
                                                    class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h6 class="mb-1">Marketing Updates</h6>
                                                        <small class="text-muted">Marketing and promotional emails</small>
                                                    </div>
                                                    <label class="toggle-switch">
                                                        <input type="checkbox" />
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Email Configuration -->
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-cog me-2"></i>Email Config
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">SMTP Host</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            value="smtp.gmail.com" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">SMTP Port</label>
                                        <input type="number" class="form-control" value="587" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Username</label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            value="noreply@company.com" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Password</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            value="••••••••" />
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            checked />
                                        <label class="form-check-label">Use SSL/TLS</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Settings -->
                <div id="system" class="settings-section">
                    <h2 class="mb-4 fw-bold">
                        <i class="fas fa-server me-2 text-primary"></i>System Settings
                    </h2>

                    <!-- System Info -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card stat-card">
                                <i class="fas fa-microchip fa-2x mb-2"></i>
                                <h4 class="fw-bold mb-1">2.4 GHz</h4>
                                <p class="mb-0">CPU Usage</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card-success">
                                <i class="fas fa-memory fa-2x mb-2"></i>
                                <h4 class="fw-bold mb-1">4.2 GB</h4>
                                <p class="mb-0">Memory Used</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card-info">
                                <i class="fas fa-hdd fa-2x mb-2"></i>
                                <h4 class="fw-bold mb-1">125 GB</h4>
                                <p class="mb-0">Storage Used</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card-warning">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <h4 class="fw-bold mb-1">99.9%</h4>
                                <p class="mb-0">Uptime</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- System Configuration -->
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-tools me-2"></i>System Configuration
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Max Upload Size (MB)</label>
                                        <input type="number" class="form-control" value="50" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Session Cleanup (hours)</label>
                                        <input type="number" class="form-control" value="24" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Log Retention (days)</label>
                                        <input type="number" class="form-control" value="30" />
                                    </div>
                                    <div class="form-check mb-3">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            checked />
                                        <label class="form-check-label">Enable Debug Mode</label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            checked />
                                        <label class="form-check-label">Enable Error Reporting</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Maintenance -->
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-wrench me-2"></i>Maintenance
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2 mb-3">
                                        <button class="btn btn-outline-primary btn-custom">
                                            <i class="fas fa-broom me-2"></i>Clear Cache
                                        </button>
                                        <button class="btn btn-outline-info btn-custom">
                                            <i class="fas fa-sync me-2"></i>Optimize Database
                                        </button>
                                        <button class="btn btn-outline-success btn-custom">
                                            <i class="fas fa-chart-line me-2"></i>System Health
                                            Check
                                        </button>
                                        <button class="btn btn-outline-warning btn-custom">
                                            <i class="fas fa-download me-2"></i>Download Logs
                                        </button>
                                    </div>
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <strong>Last Maintenance:</strong> 2 days ago
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Backup & Restore -->
                <div id="backup" class="settings-section">
                    <h2 class="mb-4 fw-bold">
                        <i class="fas fa-database me-2 text-primary"></i>Backup &
                        Restore
                    </h2>

                    <div class="row">
                        <div class="col-md-8">
                            <!-- Backup Settings -->
                            <div class="card">
                                <div class="card-header bg-success text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-shield-alt me-2"></i>Automatic Backup
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Backup Frequency</label>
                                                <select class="form-select">
                                                    <option>Daily</option>
                                                    <option>Weekly</option>
                                                    <option>Monthly</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Backup Time</label>
                                                <input
                                                    type="time"
                                                    class="form-control"
                                                    value="02:00" />
                                            </div>
                                            <div class="form-check mb-3">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    checked />
                                                <label class="form-check-label">Include Database</label>
                                            </div>
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    checked />
                                                <label class="form-check-label">Include Files</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Retention Period (days)</label>
                                                <input
                                                    type="number"
                                                    class="form-control"
                                                    value="30" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Storage Location</label>
                                                <select class="form-select">
                                                    <option>Local Server</option>
                                                    <option>Google Drive</option>
                                                    <option>AWS S3</option>
                                                    <option>Dropbox</option>
                                                </select>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    checked />
                                                <label class="form-check-label">Compress Backup</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" />
                                                <label class="form-check-label">Email Notification</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Manual Backup -->
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-hand-paper me-2"></i>Manual Backup
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-primary btn-custom">
                                                    <i class="fas fa-download me-2"></i>Create Full
                                                    Backup
                                                </button>
                                                <button class="btn btn-outline-primary btn-custom">
                                                    <i class="fas fa-database me-2"></i>Database Only
                                                </button>
                                                <button class="btn btn-outline-info btn-custom">
                                                    <i class="fas fa-folder me-2"></i>Files Only
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="alert alert-success">
                                                <i class="fas fa-check-circle me-2"></i>
                                                <strong>Last Backup:</strong><br />
                                                Sep 14, 2024 02:00 AM<br />
                                                <small>Size: 245 MB</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Recent Backups -->
                            <div class="card h-100">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-history me-2"></i>Recent Backups
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <div
                                            class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Full Backup</strong><br />
                                                <small class="text-muted">Sep 14, 2024</small>
                                            </div>
                                            <div>
                                                <span class="badge bg-success">245 MB</span>
                                                <button class="btn btn-sm btn-outline-primary ms-1">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Database Backup</strong><br />
                                                <small class="text-muted">Sep 13, 2024</small>
                                            </div>
                                            <div>
                                                <span class="badge bg-info">45 MB</span>
                                                <button class="btn btn-sm btn-outline-primary ms-1">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Full Backup</strong><br />
                                                <small class="text-muted">Sep 12, 2024</small>
                                            </div>
                                            <div>
                                                <span class="badge bg-success">238 MB</span>
                                                <button class="btn btn-sm btn-outline-primary ms-1">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Files Backup</strong><br />
                                                <small class="text-muted">Sep 11, 2024</small>
                                            </div>
                                            <div>
                                                <span class="badge bg-warning">180 MB</span>
                                                <button class="btn btn-sm btn-outline-primary ms-1">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Restore Section -->
                                    <div class="mt-4">
                                        <h6 class="fw-bold">Restore System</h6>
                                        <div class="mb-3">
                                            <input
                                                type="file"
                                                class="form-control"
                                                accept=".sql,.zip" />
                                        </div>
                                        <button class="btn btn-warning btn-custom w-100">
                                            <i class="fas fa-upload me-2"></i>Restore from File
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="/api/user/create" method="POST" id="addUser">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus me-2"></i>Add New User
                    </h5>
                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="full_name" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Role <span class="text-danger">*</span></label>
                                <select class="form-select" required name="role">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select class="form-select" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-c-primary">
                        <i class="fas fa-save me-2"></i>Save User
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/api/user/profile/update" method="POST" id="updateUser">
                <input type="hidden" id="user-edit-id" name="user_id" />
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-edit me-2"></i>Edit User
                    </h5>
                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Full Name</label>
                                <input type="text" class="form-control" id="user-edit-full-name" name="full_name" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email Address</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    id="user-edit-email" />
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Role</label>
                                <select class="form-select" name="role" id="user-edit-role">
                                    <option value="user">User</option>
                                    <option value="admin" selected>Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select class="form-select" name="status" id="user-edit-status">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-c-primary">
                        <i class="fas fa-save me-2"></i>Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Navigation functionality
    function showSection(sectionId) {

        // Hide all sections
        document.querySelectorAll(".settings-section").forEach((section) => {
            section.classList.remove("active");
            console.log(section);
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

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Form validation
    document.addEventListener("DOMContentLoaded", function() {
        // Add form validation here if needed
        console.log("Settings page loaded successfully");
    });

    // Save settings function
    function saveSettings() {
        // Add save functionality here
        alert("Settings saved successfully!");
    }

    document.getElementById("updateSetting").addEventListener("submit", function(e) {
        e.preventDefault();

        const result = document.getElementById("result");
        result.innerHTML = "";

        const form = e.target;
        const formData = new FormData(form);

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        fetch(form.action, {
                method: form.method,
                body: formData,
            })
            .then((response) => response.text())
            .then((data) => {
                result.innerHTML = data;
            })
            .catch((error) => {
                console.error("Error:", error);
            })
            .finally(() => {
                submitBtn.disabled = false;
            });
    });

    document.getElementById("addUser").addEventListener("submit", function(e) {
        e.preventDefault();

        const result = document.getElementById("result");
        result.innerHTML = "";

        const form = e.target;
        const formData = new FormData(form);

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        fetch(form.action, {
                method: form.method,
                body: formData,
            })
            .then((response) => response.text())
            .then((data) => {
                result.innerHTML = data;

            })
            .catch((error) => {
                console.error("Error:", error);
            })
            .finally(() => {
                const modalElement = document.getElementById('addUserModal');
                const modalInstance = bootstrap.Modal.getInstance(modalElement) ||
                    new bootstrap.Modal(modalElement);
                modalInstance.hide();
                submitBtn.disabled = false;
                document.getElementById("filterUsers").dispatchEvent(new Event("submit", {
                    cancelable: true,
                    bubbles: true
                }));

            });
    });

    document.getElementById("filterUsers").addEventListener("submit", function(e) {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);

        const result = document.getElementById("userDatas");

        fetch(form.action, {
                method: form.method,
                body: formData,
            })
            .then((response) => response.text())
            .then((data) => {
                result.innerHTML = data;
            })
            .catch((error) => {
                console.error("Error:", error);
            });

    })
    document.getElementById("updateUser").addEventListener("submit", function(e) {
        e.preventDefault();

        const result = document.getElementById("result");
        result.innerHTML = "";

        const form = e.target;
        const formData = new FormData(form);

        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        fetch(form.action, {
                method: form.method,
                body: formData,
            })
            .then((response) => response.text())
            .then((data) => {
                result.innerHTML = data;

            })
            .catch((error) => {
                console.error("Error:", error);
            })
            .finally(() => {
                const modalElement = document.getElementById('editUserModal');
                const modalInstance = bootstrap.Modal.getInstance(modalElement) ||
                    new bootstrap.Modal(modalElement);
                modalInstance.hide();
                submitBtn.disabled = false;
                document.getElementById("filterUsers").dispatchEvent(new Event("submit", {
                    cancelable: true,
                    bubbles: true
                }));

            });

    })

    function ajaxGet(url, msg) {
        const confirmMessage = confirm(msg)
        if (confirmMessage) {
            fetch(url, {
                    method: 'GET',
                })
                .then((response) => response.text())
                .then((data) => {
                    document.getElementById('result').innerHTML = data;
                    document.getElementById("filterUsers").dispatchEvent(new Event("submit", {
                        cancelable: true,
                        bubbles: true
                    }));
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
    }

    function editUser(id, fullName, email, role, status) {
        document.getElementById('user-edit-full-name').value = (fullName);
        document.getElementById('user-edit-email').value = (email);
        document.getElementById('user-edit-role').value = (role);
        document.getElementById('user-edit-status').value = (status);
        document.getElementById('user-edit-id').value = (id);
    }
</script>
<?php include_once __DIR__ . '/../footer_view.php'; ?>