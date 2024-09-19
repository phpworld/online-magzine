<!-- admin/payment_history.php -->
<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="text-center">
        <h1 class="mb-4">Payment Successful</h1>
        <?php if ($transaction_id): ?>
            <p class="lead">Your payment was successful. Transaction ID: <strong><?= $transaction_id; ?></strong></p>
        <?php else: ?>
            <p class="lead">Your payment was successful. Thank you for your purchase!</p>
        <?php endif; ?>
        <a href="<?php echo base_url('/user/login'); ?>" class="btn btn-primary mt-3"> Login Again</a>
    </div>
</div>

<?= $this->endSection() ?>
