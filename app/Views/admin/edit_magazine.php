<!-- admin/edit_magazine.php -->
<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>

<h2>Edit Magazine</h2>

<form action="<?= base_url('admin/editMagazine/'.$magazine['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="title">Magazine Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $magazine['title'] ?>" required>
    </div>

    <div class="form-group">
        <label for="issue_date">Issue Date</label>
        <input type="date" class="form-control" id="issue_date" name="issue_date" value="<?= $magazine['issue_date'] ?>" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required><?= $magazine['description'] ?></textarea>
    </div>

    <div class="form-group">
        <label for="price">Price (INR)</label>
        <input type="number" class="form-control" id="price" name="price" value="<?= $magazine['price'] ?>" step="0.01" required>
    </div>

    <div class="form-group">
        <label for="file">Upload New PDF (Optional)</label>
        <input type="file" class="form-control-file" id="file" name="file">
        <small>Current File: <?= $magazine['file_path'] ?></small>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Update Magazine</button>
</form>

<?= $this->endSection() ?>
