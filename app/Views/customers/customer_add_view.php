<?php include_once __DIR__ . '/../header_view.php'; ?>
<?php include_once __DIR__ . '/../navbar_view.php'; ?>

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-12">
            <h2><?= t('add_customer'); ?></h2>
        </div>
    </div>

    <div class="dashboard-section">
        <div id="result"></div>
        <form class="container my-3" method="POST" action="/api/customer/create" id="addCustomer">
            <div class="row g-4">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fullName" class="form-label"><?= t('full_name') ?> <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="fullName" name="full_name" required maxlength="200"
                            placeholder="Enter <?= t('full_name') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label"><?= t('email') ?></label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="255"
                            placeholder="example@mail.com">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label"><?= t('phone') ?></label>
                        <input type="tel" class="form-control" id="phone" name="phone" maxlength="50"
                            placeholder="+61 812 3456 7890">
                    </div>

                    <div class="mb-3">
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
                        <label for="note" class="form-label"><?= t('note') ?></label>
                        <textarea class="form-control" id="note" name="note" rows="4"
                            placeholder="<?= t('note_placeholder') ?>..."></textarea>
                    </div>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-c-primary px-5"><?= t('save') ?></button>
                    <button type="reset" class="btn btn-outline-secondary ms-3"><?= t('reset') ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include_once __DIR__ . '/../footer_view.php'; ?>