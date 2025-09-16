<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-12">
            <h2>Edit Service</h2>
        </div>
    </div>

    <div class="dashboard-section p-4">
        <div id="result"></div>
        <form action="/api/service/update/<?= $service->id ?>" method="POST" id="updateService">
            <input type="hidden" value="<?= $service->id ?>">
            <div class="row g-4">
                <!-- Nama Layanan -->
                <div class="col-md-6">
                    <label for="serviceName" class="form-label fw-semibold"><?= t('service_name') ?> <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="serviceName" name="name" maxlength="200"
                        value="<?= $service->name ?>" required>
                    <div class="form-text">Max 200 character.</div>
                </div>

                <!-- Harga Default -->
                <div class="col-md-6">
                    <label for="defaultPrice" class="form-label fw-semibold"><?= t('default_price') ?> <span
                            class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text"><?= $currency ?></span>
                        <input type="number" class="form-control" id="defaultPrice" name="default_price" step="0.01"
                            min="0" required value="<?= $service->default_price ?>" placeholder="10.000,00">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="col-12">
                    <label for="description" class="form-label fw-semibold"><?= t('service_description') ?></label>
                    <textarea class="form-control" id="description" name="description"
                        rows="4"><?= $service->description ?></textarea>
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