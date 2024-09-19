<!-- admin/manage_users.php -->
<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>

<h2>Manage Users</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?//=// $user['phone'] ?></td>
                <td><?//= $user['role'] ?></td>
                <td>
                    <a href="<?= base_url('admin/viewUser/'.$user['id']) ?>" class="btn btn-info">View</a>
                    <a href="<?= base_url('admin/deleteUser/'.$user['id']) ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
