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
            <div id="result"></div>
            <form action="/api/order/create" method="POST" id="addOrder">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Customer Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="customer-type" name="customer_type"
                                value="1">
                            <label class="form-check-label" for="customer-type">
                                <small>New Customer?</small>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row" id="customer-type-section">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="searchCustomer">Customer</label>
                        <input type="text" class="form-control" placeholder="type a name to search customer"
                            onkeyup="searchCustomer(event)">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Searched customer will appear here:</label>
                        <div id="resultSearchedCustomer" class="overflow-auto" style="max-height:300px">...</div>
                    </div>
                </div>
                <div class="row">
                    <div class="accordion mb-4" id="userInfoAccordion" style="display: none;">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingUserInfo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseUserInfo" aria-expanded="true"
                                    aria-controls="collapseUserInfo">
                                    Customer Information
                                </button>
                            </h2>
                            <div id="collapseUserInfo" class="accordion-collapse collapse show"
                                aria-labelledby="headingUserInfo" data-bs-parent="#userInfoAccordion">
                                <div class="accordion-body">
                                    <div class="row g-3">
                                        <!-- Kolom Kiri -->
                                        <div class="col-md-6">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="fullName" class="form-label"><?= t('full_name') ?> <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="fullName"
                                                        name="full_name" maxlength="200">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email" class="form-label"><?= t('email') ?></label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        maxlength="255" placeholder="example@mail.com">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="phone" class="form-label"><?= t('phone') ?></label>
                                                    <input type="tel" class="form-control" id="phone" name="phone"
                                                        maxlength="50" placeholder="+61 812 3456 7890">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="birthday"
                                                        class="form-label"><?= t('birthday') ?></label>
                                                    <input type="date" class="form-control" id="birthday"
                                                        name="birthday">
                                                    <small><i>*The year is ignored — this is only used to save birthdays
                                                            for reminders and congratulations.</i></small>
                                                </div>
                                                <div class="col-12">
                                                    <label for="companyName"
                                                        class="form-label"><?= t('company_name') ?></label>
                                                    <input type="text" class="form-control" id="companyName"
                                                        name="company_name" maxlength="255"
                                                        placeholder="Company or organization">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="source" class="form-label"><?= t('source') ?></label>
                                                    <select class="form-select" id="source" name="source">
                                                        <option value="Ads">Ads</option>
                                                        <option value="Website">Website</option>
                                                        <option value="Tiktok">Tiktok</option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="Instagram">Instagram</option>
                                                        <option value="Referral">Referral</option>
                                                        <option value="Google">Google</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="tagId" class="form-label"><?= t('tag') ?></label>
                                                    <select class="form-select multiselect w-100" id="tagId"
                                                        name="tag_id[]" multiple>
                                                        <?php foreach ($tags as $tag): ?>
                                                            <option value="<?= $tag->id ?>"><?= $tag->name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Kolom Kanan -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label"><?= t('address') ?></label>
                                                <textarea class="form-control" id="address" name="address"
                                                    rows="3"></textarea>
                                            </div>

                                            <div class="row g-3 mb-3">
                                                <div class="col-md-5">
                                                    <label for="suburb" class="form-label"><?= t('suburb') ?></label>
                                                    <input type="text" class="form-control" id="suburb" name="suburb">

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="state" class="form-label"><?= t('state') ?></label>
                                                    <input type="text" class="form-control" id="state" name="state">

                                                </div>
                                                <div class="col-md-3">
                                                    <label for="postcode"
                                                        class="form-label"><?= t('postcode') ?></label>
                                                    <input type="text" class="form-control" id="postcode"
                                                        name="postcode">

                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="note" class="form-label">Customer note</label>
                                                <textarea class="form-control" id="note" name="note" rows="4"
                                                    placeholder="<?= t('note_placeholder') ?>..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Customer & Order Info -->
                <div class="row form-section">
                    <div class="col-6 mb-3">
                        <label class="form-label" for="orderNote">Order note</label>
                        <textarea class="form-control" id="orderNote" rows="2" name="order_note"
                            placeholder="Add note..."></textarea>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="orderDate">Order Date</label>
                        <input type="datetime-local" class="form-control" name="order_date" id="orderDate"
                            value="<?= date('Y-m-d H:i:s') ?>">
                    </div>


                </div>

                <!-- Order Items -->
                <div class="form-section">
                    <hr>
                    <h6 class="mb-3">Order Items</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Custom Price</th>
                                </tr>
                            </thead>
                            <tbody id="order-items">
                                <tr>
                                    <td>
                                        <select name="item[]" class="form-select serviceSelect">
                                            <option value="">Select Item</option>
                                            <?php foreach ($services as $service): ?>
                                                <option value="<?= $service->id ?>" data-name="<?= $service->name ?>" data-price="<?= $service->default_price ?>">
                                                    <?= $service->name ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input name="qty[]" type="number" class="form-control qtyInput" placeholder="Qty" min="1">
                                        <input name="service_name[]" type="hidden" class="form-control serviceName">
                                    </td>
                                    <td>
                                        <input name="price[]" type="number" class="form-control priceInput" placeholder="Price" step="0.01" readonly>
                                    </td>
                                    <td>
                                        <input type="number" class="form-control totalInput" placeholder="Total" step="0.01" readonly>
                                    </td>
                                    <td>
                                        <input name="custom_price[]" type="number" class="form-control customPriceInput" placeholder="Custom price" step="0.01">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addRow">+ Add Item</button>
                    </div>
                    <div class="text-end mb-3">
                        <input type="hidden" name="total" id="totalAmountHidden">
                        <strong>Total Amount: $<span id="totalAmount">0.00</span></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 mb-3">
                        <label class="form-label" for="orderStatus">Order Status</label>
                        <select class="form-select" id="orderStatus" name="order_status">
                            <option value="confirmed" selected>Confirmed</option>
                            <option value="booked">Booked</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="col-3 d-none" id="booked-at">
                        <label class="form-label" for="orderStatus">Booked At</label>
                        <input type="datetime-local" class="form-control" name="booked_at" id="bookedAt">
                    </div>
                </div>
                <!-- Payment Section -->
                <div class="form-section">
                    <hr>
                    <h6 class="mb-3">Payment</h6>
                    <small><i>*You can skip this section if the order has not been paid for.</i></small>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label" for="paymentAmount">Amount Paid</label>

                            <input type="number" class="form-control" id="paymentAmount" name="amount_paid" step="0.01">

                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="paymentMethod">Payment Method</label>
                            <select class="form-select" id="paymentMethod" name="payment_method">
                                <option value="cash">Cash</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="card">Card</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="paymentRef">Reference</label>
                            <input type="text" class="form-control" id="paymentRef" name="reference">
                        </div>
                        <div class="col-8">
                            <label class="form-label" for="paymentNote">Payment Note</label>
                            <textarea class="form-control" id="paymentNote" name="payment_note"></textarea>
                        </div>

                    </div>
                </div>

                <!-- Status & Actions -->
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-c-primary px-5"><?= t('save') ?></button>
                    <button type="reset" class="btn btn-outline-secondary ms-3"><?= t('reset') ?></button>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
    const orderItems = document.getElementById("order-items");
    const addRowBtn = document.getElementById("addRow");
    const grandTotalInput = document.getElementById("grandTotalInput");
    const totalAmountSpan = document.getElementById("totalAmount");
    const totalAmountHidden = document.getElementById("totalAmountHidden");

    // update per baris
    function updateRowTotal(row) {
        let qty = parseFloat(row.querySelector(".qtyInput").value);
        if (isNaN(qty) || qty <= 0) {
            qty = 1; // default ke 1 kalau kosong atau <=0
        }

        const price = parseFloat(row.querySelector(".priceInput").value) || 0;
        const customPrice = parseFloat(row.querySelector(".customPriceInput").value) || 0;
        const totalInput = row.querySelector(".totalInput");

        let rowTotal = qty * price;
        if (customPrice > 0) {
            rowTotal = customPrice; // override pakai custom price
        }

        totalInput.value = rowTotal.toFixed(2);
        updateGrandTotal();
    }


    // update grand total
    function updateGrandTotal() {
        let grandTotal = 0;
        orderItems.querySelectorAll("tr").forEach(row => {
            const total = parseFloat(row.querySelector(".totalInput").value) || 0;
            grandTotal += total;
        });
        totalAmountSpan.textContent = grandTotal.toFixed(2);
        totalAmountHidden.value = grandTotal.toFixed(2);
    }

    // binding event ke baris
    function bindRowEvents(row) {
        const serviceSelect = row.querySelector(".serviceSelect");
        const qtyInput = row.querySelector(".qtyInput");
        const priceInput = row.querySelector(".priceInput");
        const customPriceInput = row.querySelector(".customPriceInput");
        const serviceName = row.querySelector(".serviceName");

        serviceSelect.addEventListener("change", function() {
            const selected = this.options[this.selectedIndex];
            priceInput.value = selected.dataset.price || 0;
            serviceName.value = selected.dataset.name || '';
            updateRowTotal(row);
        });
        qtyInput.addEventListener("input", () => updateRowTotal(row));
        customPriceInput.addEventListener("input", () => updateRowTotal(row));
    }

    // add row
    addRowBtn.addEventListener("click", () => {
        const firstRow = orderItems.querySelector("tr");
        const newRow = firstRow.cloneNode(true);
        newRow.querySelectorAll("input").forEach(i => i.value = "");
        newRow.querySelector(".serviceSelect").selectedIndex = 0;
        orderItems.appendChild(newRow);
        bindRowEvents(newRow);
    });

    // initial binding
    orderItems.querySelectorAll("tr").forEach(row => bindRowEvents(row));
</script>

<?php include_once __DIR__ . '/../footer_view.php'; ?>