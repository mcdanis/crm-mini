<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2>Customer List</h2>
            <a href="/customer/add" class="btn btn-c-primary">Add Customer</a>
        </div>
    </div>

    <div class="dashboard-section">
        <div class="table-responsive" style="max-width: 1300px; overflow-x: auto;">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th><?= t('full_name') ?></th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company</th>
                        <th>Source</th>
                        <th>Address</th>
                        <th>Number of Orders</th>
                        <th>Total Order Value</th>
                        <th>Last Order</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="customer-list">
                    <?php
                    $no = 1;
                    foreach ($customers as $c):
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $c->full_name ?></td>
                            <td><?= $c->email ?></td>
                            <td><?= $c->phone ?></td>
                            <td><?= $c->company_name ?></td>
                            <td><?= $c->source ?></td>
                            <td><?= $c->address ?></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="text-center">
                                <a href="/customer/detail/<?= $c->id ?>" class="btn btn-sm btn-outline-primary me-1"><i
                                        class="bi bi-eye"></i></a>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-center">
                <?php if (!empty($customers)): ?>
                    <?php $lastCustomer = $customers[count($customers) - 1]; ?>
                    <button id="load-more" class="btn btn-c-primary btn-sm px-5" data-last-id="<?= $lastCustomer->id ?>">Load More</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loadBtn = document.getElementById("load-more");
        if (loadBtn) {
            loadBtn.addEventListener("click", function() {
                let lastId = this.dataset.lastId;

                fetch("?last_id=" + lastId, {
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    })
                    .then(res => res.json())
                    .then(res => {
                        let list = document.getElementById("customer-list");
                        if (res.data.length > 0) {
                            res.data.forEach((c, index) => {
                                let tr = document.createElement("tr");

                                tr.innerHTML = `
                                    <td></td>
                                    <td>${c.full_name}</td>
                                    <td>${c.email}</td>
                                    <td>${c.phone ?? "-"}</td>
                                    <td>${c.company_name ?? "-"}</td>
                                    <td>${c.source ?? "-"}</td>
                                    <td>${c.address ?? "-"}</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td class="text-center">
                                        <a href="/customer/detail/${c.id}" class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                `;

                                list.appendChild(tr);
                            });

                            // update last_id ke id terakhir
                            this.dataset.lastId = res.data[res.data.length - 1].id;

                            // kalau data kurang dari perPage, hapus tombol
                            if (!res.has_more) {
                                this.remove();
                            }
                        } else {
                            this.remove();
                        }

                        // update ulang nomor urut
                        let rows = list.querySelectorAll("tr");
                        rows.forEach((row, idx) => {
                            row.querySelector("td").textContent = idx + 1;
                        });
                    });
            });
        }
    });
</script>
<?php include_once __DIR__ . '/../footer_view.php'; ?>