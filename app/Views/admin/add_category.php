<!-- admin/view_user.php -->
<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>

<h2>User Profile</h2>
<form action="<?= base_url('admin/add_category') ?>" method="post">
    <label for="category_name">Category Name:</label>
    <input type="text" name="category_name" id="category_name" required>
    
    <button type="submit" class="btn btn-primary mt-3">Add Category</button>
</form>

<a href="<?= base_url('admin/manageUsers') ?>" class="btn btn-primary">Back to Users</a>

<?= $this->endSection() ?>
