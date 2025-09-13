<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-12">
            <h2><?= t('add_customer'); ?></h2>
        </div>
    </div>

    <div class="dashboard-section">
        <form class="container my-3">
            <div class="row g-4">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="fullName" name="full_name" required maxlength="200" placeholder="Enter full name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="255" placeholder="example@mail.com">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" maxlength="50" placeholder="+62 812 3456 7890">
                    </div>

                    <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" class="form-control" id="birthday" name="birthday">
                    </div>

                    <div class="mb-3">
                        <label for="companyName" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="companyName" name="company_name" maxlength="255" placeholder="Company or organization">
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="source" class="form-label">Source</label>
                            <select class="form-select" id="source" name="source">
                                <option value="" selected>Choose source</option>
                                <option value="instagram">Instagram</option>
                                <option value="referral">Referral</option>
                                <option value="google">Google</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tagId" class="form-label">Tag ID</label>
                            <select class="form-select" id="tagId" name="tag_id">
                                <option value="" selected>Choose tag</option>
                                <option value="vip">VIP</option>
                                <option value="regular">Regular</option>
                                <option value="new">New</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Street address, building, etc."></textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label for="suburb" class="form-label">Suburb</label>
                            <input type="text" class="form-control" id="suburb" name="suburb" maxlength="150" placeholder="Suburb">
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" maxlength="150" placeholder="State">
                        </div>
                        <div class="col-md-3">
                            <label for="postcode" class="form-label">Postcode</label>
                            <input type="text" class="form-control" id="postcode" name="postcode" maxlength="20" placeholder="Postcode">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note" rows="4" placeholder="Additional notes"></textarea>
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-c-primary px-4">Save Customer</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php include_once __DIR__ . '/../footer_view.php'; ?>