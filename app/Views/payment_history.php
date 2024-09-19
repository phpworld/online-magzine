<!-- admin/payment_history.php -->
<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <h1 class="mb-4">Payment History</h1>
<style>
ul.pagination li {
    padding: 10px;
    background-color: lightblue;
    margin: 4px;
    border-radius: 8px;
}
</style>
    <!-- Table for Payment History -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($payments)): ?>
                    <?php foreach ($payments as $payment): ?>
                        <tr>
                            <td><?= esc($payment['transaction_id']) ?></td>
                            <td><?= number_format($payment['amount'], 2) ?></td>
                            <td><?= esc($payment['payment_date']) ?></td>
                            <td><?= esc(ucfirst($payment['payment_status'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No payments found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?= $pager->links() ?>
        </ul>
    </nav>

    <!-- Back to Dashboard Link -->
    
</div>

<?= $this->endSection() ?>
