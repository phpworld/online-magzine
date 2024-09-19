<!-- admin/view_user.php -->
<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>

<h2>User Profile</h2>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?= $user['id'] ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?= $user['name'] ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?= $user['email'] ?></td>
    </tr>
    <tr>
        <th>Phone</th>
        <td><?= $user['phone'] ?></td>
    </tr>
    <tr>
        <th>Role</th>
        <td><?= $user['role'] ?></td>
    </tr>
</table>

<a href="<?= base_url('admin/manageUsers') ?>" class="btn btn-primary">Back to Users</a>

<?= $this->endSection() ?>
