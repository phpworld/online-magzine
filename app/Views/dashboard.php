<!-- admin/magazines.php -->
<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>


    <div class="container">
        <h1>Welcome, <?= session()->get('name') ?>!</h1>
        <p>Email: <?= session()->get('email') ?></p>

        

        <div class="mt-5">
            <h3>Available Magazines</h3>
           
            <div class="row">
                <?php foreach ($magazines as $magazine): ?>
                <div class="col-md-4">
                <div class="card">
                <img src="<?= base_url('/public/magazine_covers/' . $magazine['cover_image']) ?>" alt="<?= $magazine['title'] ?>" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title"><?= $magazine['title'] ?></h5>
                <p class="card-text">Price: ₹<?= number_format($magazine['price'], 2) ?></p>
               

    <a href="<?= base_url('magazine/details/' . $magazine['id']) ?>" class="btn btn-success ">Order Now</a>
                
                </div>
                </div>
                </div>
                    
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-4">
            <a href="<?= base_url('user/logout') ?>" class="btn btn-danger">Logout</a>
        </div>
    </div>
<?= $this->endSection() ?>