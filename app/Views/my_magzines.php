<!-- admin/magazines.php -->
<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>


    <div class="container">
        <h1>Welcome, <?= session()->get('name') ?>!</h1>
        <p>Email: <?= session()->get('email') ?></p>

        

     <div class="container mt-5">
    <h1 class="mb-4">Magazines Purchased by User</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
					<th>Image</th>                   
				    <th>Title</th>
                    <th>Price </th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($completedMagazines)): ?>
                    <?php 
					$i=1;
					foreach ($completedMagazines as $magazine): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><img src="<?= base_url('public/magazine_covers/'.$magazine['cover_image']); ?>" alt="Cover Image" class="img-fluid" style="max-width: 100px;"></td>
                            <td><?php echo $magazine['title']; ?></td>
                            <td><?php echo $magazine['price']; ?></td>
                            <td>  <a href="<?= base_url('public/magazines/' . $magazine['file_path']) ?>" class="btn btn-primary btn-sm" download>
                                        Download
                                    </a> &nbsp; <a href="<?= base_url('public/magazines/' . $magazine['file_path']) ?>" class="btn btn-success btn-sm" target="_blank">View</a> </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No completed magazines found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

        
    </div>
<?= $this->endSection() ?>