<!-- admin/manage_subscriptions.php -->
<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>

<h2>Manage Subscriptions</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Magazine ID</th>
            <th>Frequency</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($subscriptions as $subscription): ?>
            <tr>
                <td><?= $subscription['id'] ?></td>
                <td><?= $subscription['user_id'] ?></td>
                <td><?= $subscription['magazine_id'] ?></td>
                <td><?= $subscription['frequency'] ?></td>
                <td><?= $subscription['status'] ?></td>
                <td>
                    <a href="<?= base_url('admin/editSubscription/'.$subscription['id']) ?>" class="btn btn-primary">Edit</a>
                    <a href="<?= base_url('admin/deleteSubscription/'.$subscription['id']) ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
