<?php include_once __DIR__ . '/../header_view.php'; ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card dashboard-section p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <!-- Logo -->
            <img src="https://via.placeholder.com/80" alt="Logo" class="mb-3">
            <h4 class="fw-semibold">Plumber Sync</h4>
            <p class="text-muted">Please login to your account</p>
        </div>

        <!-- Error Message -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo htmlspecialchars(urldecode($_GET['error'])); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Success Message -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo htmlspecialchars(urldecode($_GET['success'])); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form method="POST" action="/login" id="loginForm">
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" 
                       class="form-control" 
                       id="email" 
                       name="email" 
                       placeholder="example@mail.com" 
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                       required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" 
                       class="form-control" 
                       id="password" 
                       name="password" 
                       placeholder="Enter your password" 
                       required>
            </div>

            <!-- Remember me -->
            <div class="mb-3 form-check">
                <input type="checkbox" 
                       class="form-check-input" 
                       id="rememberMe" 
                       name="remember_me" 
                       value="1">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-c-primary" id="loginBtn">
                    <span class="spinner-border spinner-border-sm d-none" id="loginSpinner" role="status"></span>
                    <span id="loginText">Login</span>
                </button>
            </div>

            <!-- Forgot password -->
            <div class="text-center mt-3">
                <a href="/forgot-password" class="text-muted small">Forgot password?</a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('loginBtn');
    const spinner = document.getElementById('loginSpinner');
    const text = document.getElementById('loginText');
    
    // Disable button and show spinner
    submitBtn.disabled = true;
    spinner.classList.remove('d-none');
    text.textContent = 'Logging in...';
    
    // Re-enable after 5 seconds (fallback)
    setTimeout(() => {
        submitBtn.disabled = false;
        spinner.classList.add('d-none');
        text.textContent = 'Login';
    }, 5000);
});
</script>

<?php include_once __DIR__ . '/../footer_view.php'; ?>