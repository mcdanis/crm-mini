<?php include_once __DIR__ . '/../header_view.php'; ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card dashboard-section p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <!-- Logo -->
            <img src="https://via.placeholder.com/80" alt="Logo" class="mb-3">
            <h4 class="fw-semibold">Plumber Sync</h4>
            <p class="text-muted">Please login to your account</p>
        </div>

        <form>
            <!-- Email -->
            <div class="mb-3">
                <label for="loginEmail" class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" id="loginEmail" placeholder="example@mail.com" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="loginPassword" class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control" id="loginPassword" placeholder="Enter your password" required>
            </div>

            <!-- Remember me -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-c-primary">Login</button>
            </div>

            <!-- Forgot password -->
            <div class="text-center mt-3">
                <a href="/forgot-password" class="text-muted small">Forgot password?</a>
            </div>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../footer_view.php'; ?>