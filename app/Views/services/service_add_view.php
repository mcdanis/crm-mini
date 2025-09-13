<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-12">
            <h2>Add Service</h2>
        </div>
    </div>

    <div class="dashboard-section p-4">
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
        <form action="/api/service/create" method="POST">
            <div class="row g-4">
                <!-- Nama Layanan -->
                <div class="col-md-6">
                    <label for="serviceName" class="form-label fw-semibold"><?= t('service_name') ?> <span class="text-danger">*</span></label>
                    <input
                        type="text"
                        class="form-control"
                        id="serviceName"
                        name="name"
                        maxlength="200"
                        required>
                    <div class="form-text">Max 200 character.</div>
                </div>

                <!-- Harga Default -->
                <div class="col-md-6">
                    <label for="defaultPrice" class="form-label fw-semibold"><?= t('default_price') ?> <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input
                            type="number"
                            class="form-control"
                            id="defaultPrice"
                            name="default_price"
                            step="0.01"
                            min="0"
                            value="0.00"
                            required
                            placeholder="0.00">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="col-12">
                    <label for="description" class="form-label fw-semibold"><?= t('service_description') ?></label>
                    <textarea
                        class="form-control"
                        id="description"
                        name="description"
                        rows="4"></textarea>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-c-primary px-4">Simpan</button>
                <button type="reset" class="btn btn-outline-secondary ms-3">Batal</button>
            </div>
        </form>
    </div>
</div>

<?php include_once __DIR__ . '/../footer_view.php'; ?>