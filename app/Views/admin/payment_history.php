<!-- admin/payment_history.php -->
<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>
<style>
ul.pagination li {
    padding: 10px;
    background-color: lightblue;
    margin: 4px;
    border-radius: 8px;
}
</style>    
<div class="container ">
    <h4 class="mb-3">All Payment History</h4>

    <!-- Table for Payment History -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>User ID</th>
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
                            <td><?= esc($payment['user_id']) ?></td>
                            <td><?= esc($payment['amount']) ?></td>
                            <td><?= esc($payment['payment_date']) ?></td>
                            <td>
                                <span class="badge <?= esc($payment['payment_status']) === 'success' ? 'bg-success' : (esc($payment['payment_status']) === 'pending' ? 'bg-warning' : 'bg-success') ?>">
                                    <?= esc(ucfirst($payment['payment_status'])) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No payments found.</td>
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
</div>

<?= $this->endSection() ?>
