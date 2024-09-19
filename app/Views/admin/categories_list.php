<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1 class="mb-4">Categories</h1>

    <!-- Form to add a new category -->
    <form method="post" action="<?= base_url('admin/createCategory') ?>" class="row g-3 mb-4">
        <div class="col-md-8">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" name="category_name" class="form-control" id="category_name" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Add Category</button>
        </div>
    </form>

    <hr>

    <!-- List of all categories -->
    <h2 class="mt-4 mb-3">All Categories</h2>
    <ul class="list-group">
        <?php foreach ($categories as $category): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= $category['category_name'] ?>
                <div>
                    <a href="<?= base_url('admin/editCategory/' . $category['id']) ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                    <a href="<?= base_url('admin/deleteCategory/' . $category['id']) ?>" class="btn btn-sm btn-danger">Delete</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?= $this->endSection() ?>
