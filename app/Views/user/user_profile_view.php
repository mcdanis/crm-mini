<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="container main-container py-4" style="max-width: 900px;">
      <div class="card">
        <!-- Header -->
        <div class="customer-header d-flex align-items-center">
          <div class="customer-avatar">JD</div>
          <div>
            <h4>John Doe</h4>
            <p class="text-white-50">Administrator</p>
          </div>
        </div>

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
            <form id="profileForm">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Full Name</label>
                  <input type="text" class="form-control" value="John Doe" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" value="john.doe@email.com" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Phone</label>
                  <input type="text" class="form-control" value="+62 812 3456 7890">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Birthday</label>
                  <input type="date" class="form-control" value="1990-01-15">
                </div>
                <div class="col-12">
                  <label class="form-label">Address</label>
                  <textarea class="form-control" rows="2">Jl. Sudirman No.12, Jakarta</textarea>
                </div>
              </div>
              <div class="mt-4 text-end">
                <button type="submit" class="btn btn-custom btn-c-primary">
                  <i class="fas fa-save me-2"></i>Update Profile
                </button>
              </div>
            </form>
          </div>

          <!-- Password Tab -->
          <div class="tab-pane fade" id="profile-password">
            <form id="passwordForm">
              <div class="mb-3">
                <label class="form-label">Current Password</label>
                <input type="password" class="form-control" placeholder="Enter current password" required>
              </div>
              <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" placeholder="Enter new password" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" placeholder="Confirm new password" required>
              </div>
              <div class="text-end">
                <button type="submit" class="btn btn-custom btn-c-primary">
                  <i class="fas fa-key me-2"></i>Update Password
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 


<?php include_once __DIR__ . '/../footer_view.php'; ?>