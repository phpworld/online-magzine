<!-- admin/magazines.php -->
<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>


    <div class="container">
        <h1>Welcome, <?= session()->get('name') ?>!</h1>
        <p>Email: <?= session()->get('email') ?></p>

        <div class="mt-5">
            <h3>Available Magazines </h3> 
            <div class="row">
                
                <div class="col-md-12">
                <div class="card">
                <img src="<?= base_url('/public/magazine_covers/' . $magazine['cover_image']) ?>" alt="<?= $magazine['title'] ?>" class="card-img-top">
                <div class="card-body">
                <h5 class="card-title"><?= $magazine['title'] ?> - (<?= $magazine['issue_date']?>)</h5>
				
                <p class="card-text">Price: ₹<?= number_format($magazine['price'], 2) ?></p>
				<p class="card-text">Description : <?= $magazine['description'] ?></p>
			<form action="<?= base_url('payment/process') ?>" method="post">
				<input type="submit" class="btn btn-success" value="Order Now" >
				<input type="hidden" name="id" id="id" value="<?= $magazine['id'] ?>">
				<input type="hidden" name="userid" id="userid" value="<?= session()->get('id') ?>">
				<input type="hidden" name="amountEnterByUsers" id="amountEnterByUsers"  value="<?=number_format($magazine['price'], 2)?>" >
			</form>
                </div>
                </div>
                </div>
                  
            </div>
        </div>

        <div class="mt-4">
           <div id="responseMessage"></div>
        </div>
    </div>
	
	
<?= $this->endSection() ?>