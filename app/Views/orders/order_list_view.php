<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <h2>Orders</h2>
        </div>
        <div class="col-md-6 col-lg-6 text-end">
            <a href="/service/add" class="btn btn-sm btn-c-primary">Add Order</a>
        </div>
    </div>
    <div class="mt-4 p-5 rounded border ">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Litepicker({
            element: document.getElementById('litepicker'),
            singleMode: false, // aktifkan range
            format: 'YYYY-MM-DD'
        });
    });
</script>
<?php include_once __DIR__ . '/../footer_view.php'; ?>