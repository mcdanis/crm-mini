<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php
include_once __DIR__ . '/../navbar_view.php';
?>

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2>Service List</h2>
            <a href="/service/add" class="btn btn-c-primary">Add Service</a>
        </div>
    </div>

    <div class="dashboard-section">
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
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Default Price</th>
                        <th>Description</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($services as $service) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $service->name; ?></td>
                            <td><?= $service->default_price; ?></td>
                            <td><?= substr($service->description, 0, 100); ?></td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="/service/edit/<?= $service->id ?>" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="/api/service/delete/<?= $service->id ?>" onclick="return confirm ('Are you sure to deactive this service?. it will remove all data related with this Service')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../footer_view.php'; ?>