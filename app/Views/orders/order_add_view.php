<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <h2>Add Order </h2>
        </div>
    </div>

    <div class="card mt-2 shadow-sm">
        <div class="card-body">
            <form>
                <!-- Customer & Order Info -->
                <div class="row form-section">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="customer">Customer</label>
                        <select class="form-select" id="customer">
                            <option selected disabled>Select customer</option>
                            <option value="1">John Doe</option>
                            <option value="2">Jane Smith</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="orderDate">Order Date</label>
                        <input type="date" class="form-control" id="orderDate" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="orderNote">Note</label>
                        <textarea class="form-control" id="orderNote" rows="2" placeholder="Add note..."></textarea>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="form-section">
                    <h6 class="mb-3">Order Items</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" placeholder="Item name"></td>
                                    <td><input type="number" class="form-control" placeholder="Qty" min="1"></td>
                                    <td><input type="number" class="form-control" placeholder="Price" step="0.01"></td>
                                    <td><input type="number" class="form-control" placeholder="Total" step="0.01" readonly></td>
                                </tr>
                                <!-- Tambahkan baris lain sesuai kebutuhan -->
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mb-3">
                        <strong>Total Amount: $<span id="totalAmount">0.00</span></strong>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="form-section">
                    <h6 class="mb-3">Payment</h6>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label" for="paymentAmount">Amount Paid</label>
                            <input type="number" class="form-control" id="paymentAmount" placeholder="0.00" step="0.01">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="paymentMethod">Payment Method</label>
                            <select class="form-select" id="paymentMethod">
                                <option selected disabled>Select method</option>
                                <option value="cash">Cash</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="card">Card</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="paymentRef">Reference</label>
                            <input type="text" class="form-control" id="paymentRef" placeholder="Transaction ID / Ref">
                        </div>
                        <div class="col-8">
                            <label class="form-label" for="paymentNote">Payment Note</label>
                            <textarea class="form-control" id="paymentNote" rows="2" placeholder="Add payment note..."></textarea>
                        </div>
                        <div class="col-4">

                            <label class="form-label" for="orderStatus">Order Status</label>
                            <select class="form-select" id="orderStatus">
                                <option value="draft">Draft</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>

                        </div>
                    </div>
                </div>

                <!-- Status & Actions -->
                <div class="form-section d-flex justify-content-between align-items-center mt-5">

                    <div class="mt-3 mt-md-0">
                        <button type="submit" class="btn btn-c-primary px-5">Save</button>
                        <button type="button" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    // contoh update total (bisa dikembangkan untuk kalkulasi dinamis)
    const qtyInput = document.querySelector('input[placeholder="Qty"]');
    const priceInput = document.querySelector('input[placeholder="Price"]');
    const totalInput = document.querySelector('input[placeholder="Total"]');
    const totalAmountSpan = document.getElementById('totalAmount');

    function updateTotal() {
        const qty = parseFloat(qtyInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;
        const total = qty * price;
        totalInput.value = total.toFixed(2);
        totalAmountSpan.textContent = total.toFixed(2);
    }

    qtyInput.addEventListener('input', updateTotal);
    priceInput.addEventListener('input', updateTotal);
</script>
<?php include_once __DIR__ . '/../footer_view.php'; ?>