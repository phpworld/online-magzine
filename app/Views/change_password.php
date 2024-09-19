<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Change Password</h2>

            <!-- Display success or error messages -->
            <?php if (session()->get('error')) : ?>
                <div class="alert alert-danger">
                    <?= session()->get('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->get('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('user/change-password') ?>" method="post">
                <?= csrf_field() ?>

                <!-- Old Password Field -->
                <div class="mb-3">
                    <label for="old_password" class="form-label">Old Password</label>
                    <input type="password" class="form-control" name="old_password" id="old_password" required>
                </div>

                <!-- New Password Field -->
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" id="new_password" required>
                </div>

                <!-- Confirm New Password Field -->
                <div class="mb-3">
                    <label for="conf_new_password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="conf_new_password" id="conf_new_password" required>
                </div>

                <!-- Display validation errors -->
                <?php if (isset($validation)): ?>
                    <div class="alert alert-danger">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
