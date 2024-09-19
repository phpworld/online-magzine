<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Upload New Magazine</h2>

    <!-- Success and Error Messages -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Magazine Upload Form -->
    <form action="<?= base_url('admin/uploadMagazine') ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        <?= csrf_field() ?>

        <!-- Category Selection -->
        <div class="mb-3">
            <label for="category" class="form-label">Select Category</label>
            <select name="category_id" id="category" class="form-select" required>
                <option value="">Choose a category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a category.</div>
        </div>

        <!-- Magazine Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Magazine Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
            <div class="invalid-feedback">Please enter a magazine title.</div>
        </div>

        <!-- Issue Date -->
        <div class="mb-3">
            <label for="issue_date" class="form-label">Issue Date</label>
            <input type="date" class="form-control" id="issue_date" name="issue_date" required>
            <div class="invalid-feedback">Please select an issue date.</div>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            <div class="invalid-feedback">Please provide a description.</div>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price (INR)</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            <div class="invalid-feedback">Please provide a valid price.</div>
        </div>

        <!-- PDF File -->
        <div class="mb-3">
            <label for="file" class="form-label">Magazine PDF</label>
            <input type="file" class="form-control" id="file" name="file" required>
            <div class="invalid-feedback">Please upload the magazine PDF.</div>
        </div>

        <!-- Cover Image -->
        <div class="mb-3">
            <label for="cover_image" class="form-label">Magazine Cover Image</label>
            <input type="file" class="form-control" id="cover_image" name="cover_image" required>
            <div class="invalid-feedback">Please upload the cover image.</div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Upload Magazine</button>
    </form>
</div>

<script>
    // Bootstrap form validation
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission if validation fails
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<?= $this->endSection() ?>
