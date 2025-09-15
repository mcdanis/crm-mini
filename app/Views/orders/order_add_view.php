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
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Customer Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="customer-type">
                            <label class="form-check-label" for="customer-type">
                                <small>Existing Customer?</small>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="customer">Customer</label>
                        <select class="form-select" id="customer">
                            <option selected disabled>Select customer</option>
                            <option value="1">John Doe</option>
                            <option value="2">Jane Smith</option>
                        </select>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="row pl-5 pt-2 pb-3 pr-5 m-0 bg-ash mb-4">
                        <!-- Kolom Kiri -->
                        <h5>User information</h5>
                        <div class="col-md-6 row">
                            <div class="mb-3 col-md-6">
                                <label for="fullName" class="form-label"><?= t('full_name') ?> <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullName" name="full_name" required maxlength="200"
                                    placeholder="Enter <?= t('full_name') ?>">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label"><?= t('email') ?></label>
                                <input type="email" class="form-control" id="email" name="email" maxlength="255"
                                    placeholder="example@mail.com">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label"><?= t('phone') ?></label>
                                <input type="tel" class="form-control" id="phone" name="phone" maxlength="50"
                                    placeholder="+61 812 3456 7890">
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="birthday" class="form-label"><?= t('birthday') ?></label>
                                <input type="date" class="form-control" id="birthday" name="birthday">
                                <small><i>*The year is ignored — this is only used to save birthdays for reminders and
                                        congratulations.</i></small>
                            </div>

                            <div class="mb-3">
                                <label for="companyName" class="form-label"><?= t('company_name') ?></label>
                                <input type="text" class="form-control" id="companyName" name="company_name" maxlength="255"
                                    placeholder="Company or organization">
                            </div>

                            <div class="row g-3">
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
                                    <select class="form-select multiselect" id="tagId" name="tag_id[]" multiple>
                                        <?php
                                        foreach ($tags as $tag) {
                                            echo "<option value='{$tag->id}'>{$tag->name}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label"><?= t('address') ?></label>
                                <textarea class="form-control" id="address" name="address" rows="3"
                                    placeholder="<?= t('address_placeholder') ?>"></textarea>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-5">
                                    <label for="suburb" class="form-label"><?= t('suburb') ?></label>
                                    <input type="text" class="form-control" id="suburb" name="suburb" maxlength="150"
                                        placeholder="<?= t('suburb') ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="state" class="form-label"><?= t('state') ?></label>
                                    <input type="text" class="form-control" id="state" name="state" maxlength="150"
                                        placeholder="<?= t('state') ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="postcode" class="form-label"><?= t('postcode') ?></label>
                                    <input type="text" class="form-control" id="postcode" name="postcode" maxlength="20"
                                        placeholder="<?= t('postcode') ?>">
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
                <!-- Customer & Order Info -->
                <div class="row form-section">
                    <div class="col-3 mb-3">
                        <label class="form-label" for="orderNote">Order note</label>
                        <textarea class="form-control" id="orderNote" rows="2" placeholder="Add note..."></textarea>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="orderDate">Order Date</label>
                        <input type="date" class="form-control" id="orderDate" value="<?= date('Y-m-d') ?>">
                    </div>

                    <div class="col-3 mb-3">
                        <label class="form-label" for="orderStatus">Order Status</label>
                        <select class="form-select" id="orderStatus">
                            <option selected disabled>Select Order status</option>
                            <option value="booked">Booked</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="col-3 d-none" id="booked-at">
                        <label class="form-label" for="orderStatus">Booked At</label>
                        <input type="datetime-local" class="form-control" name="booked_at">
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