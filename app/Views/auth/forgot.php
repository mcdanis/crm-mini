<?php include_once __DIR__ . '/../header_view.php'; ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card dashboard-section p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <!-- Logo -->
            <img src="https://via.placeholder.com/80" alt="Logo" class="mb-3">
            <h4 class="fw-semibold">Forgot Password</h4>
            <p class="text-muted">Enter your email to reset your password</p>
        </div>

        <form>
            <!-- Email -->
            <div class="mb-3">
                <label for="forgotEmail" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" id="forgotEmail" placeholder="example@mail.com" required>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-c-primary">Send Reset Link</button>
            </div>

            <!-- Back to login -->
            <div class="text-center mt-3">
                <a href="/login" class="text-muted small">Back to Login</a>
            </div>
        </form>
    </div>
</div>


<?php include_once __DIR__ . '/../footer_view.php'; ?>