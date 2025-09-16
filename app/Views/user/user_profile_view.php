<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>
<div class="d-flex justify-content-center align-items-center min-vh-100">
  <div class="container main-container py-4" style="max-width: 900px;">
    <div class="card">
      <!-- Header -->
      <div class="customer-header d-flex align-items-center">
        <div class="customer-avatar">JD</div>
        <div>
          <h4><?= $user->full_name ?></h4>
          <p class="text-white-50"><?= $user->role ?></p>
        </div>
      </div>
      <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-triangle me-2"></i>
          <?php echo htmlspecialchars(urldecode($_GET['error'])); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <?php if (isset($_GET['danger'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-triangle me-2"></i>
          <?php echo htmlspecialchars(urldecode($_GET['danger'])); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle me-2"></i>
          <?php echo htmlspecialchars(urldecode($_GET['success'])); ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <!-- Tabs -->
      <ul class="nav nav-tabs mt-3 px-3" id="profileTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="profile-details-tab" data-bs-toggle="tab" data-bs-target="#profile-details" type="button">Profile</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="profile-password-tab" data-bs-toggle="tab" data-bs-target="#profile-password" type="button">Password</button>
        </li>
      </ul>

      <div class="tab-content p-4">
        <!-- Profile Details -->
        <div class="tab-pane fade show active" id="profile-details">
          <form id="profileForm" action="/api/user/profile/update" method="POST">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label"><?= t('full_name') ?></label>
                <input type="text" class="form-control" name="full_name" value="<?= $user->full_name ?>" required>
              </div>
              <div class="col-md-6">
                <label class="form-label"><?= t('email') ?></label>
                <input type="email" class="form-control" name="email" value="<?= $user->email ?>" required>
              </div>
              <div class="col-md-6">
                <label class="form-label"><?= t('user_role') ?></label>
                <select name="role" class="form-control">
                  <option <?php if ($user->role == 'admin') {
                            echo 'selected';
                          } ?> value="admin">Admin</option>
                  <option <?php if ($user->role == 'user') {
                            echo 'selected';
                          } ?> value="user">User</option>
                </select>
              </div>
              <!-- <div class="col-md-6">
                <label class="form-label"><?= t('status') ?></label>
                <select name="role" class="form-control">
                  <option <?php if ($user->is_active == 1) {
                            echo 'selected';
                          } ?> value="1">Active</option>
                  <option <?php if ($user->is_active == 0) {
                            echo 'selected';
                          } ?> value="0">Non Active</option>
                </select>
              </div> -->
            </div>
            <div class="mt-4 text-end">
              <button type="submit" class="btn btn-c-primary shadow">
                <i class="fas fa-save me-2"></i>Update Profile
              </button>
            </div>
          </form>
        </div>

        <!-- Password Tab -->
        <div class="tab-pane fade" id="profile-password">
          <form id="passwordForm" method="POST" action="/api/user/profile-password/update">
            <div class=" mb-3">
              <label class="form-label">Current Password</label>
              <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
            </div>
            <div class="mb-3">
              <label class="form-label">New Password</label>
              <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Confirm New Password</label>
              <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password" required>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-c-primary shadow">
                <i class="fas fa-key me-2"></i>Update Password
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php include_once __DIR__ . '/../footer_view.php'; ?>