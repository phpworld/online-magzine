<!-- admin/magazines.php -->
<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>

<h2>All Magazines</h2>

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

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Issue Date</th>
            <th>Description</th>
            <th>Price (INR)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($magazines as $magazine): ?>
            <tr>
                <td><?= $magazine['id'] ?></td>
                <td><?= $magazine['title'] ?></td>
                <td><?= $magazine['issue_date'] ?></td>
                <td><?= $magazine['description'] ?></td>
                <td><?= $magazine['price'] ?></td>
                <td>
                    <a href="<?= base_url('admin/editMagazine/'.$magazine['id']) ?>" class="btn btn-primary">Edit</a>
                    <a href="<?= base_url('admin/deleteMagazine/'.$magazine['id']) ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
