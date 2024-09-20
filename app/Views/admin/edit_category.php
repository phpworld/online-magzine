<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Category</h2>

    <form action="<?= base_url('admin/update_category/' . $category['id']) ?>" method="post" class="mt-4">
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name:</label>
            <input type="text" name="category_name" id="category_name" class="form-control" value="<?= esc($category['category_name']) ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>

    <div class="mt-3">
        <a href="<?= base_url('/admin/categories') ?>" class="btn btn-secondary">Back to Categories</a>
    </div>
</div>

<?= $this->endSection() ?>
