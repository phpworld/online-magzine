<!-- admin/magazines.php -->
<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>

<div class="container ">
    <h2 class="text-center mb-4">Admin Dashboard</h2>
    
    <div class="row text-center g-4">
        <!-- Dashboard -->
        <div class="col-6 col-md-4">
            <a href="<?= base_url('/admin/dashboard'); ?>" class="text-decoration-none">
                <div class="p-4 border rounded shadow-sm bg-light h-100">
                    <i class="ti ti-layout-dashboard" style="font-size: 80px;"></i>
                    <h5 class="mt-3">Dashboard</h5>
                </div>
            </a>
        </div>
        
        <!-- Add Categories -->
        <div class="col-6 col-md-4">
            <a href="<?= base_url('admin/categories') ?>" class="text-decoration-none">
                <div class="p-4 border rounded shadow-sm bg-light h-100">
                    <i class="ti ti-article" style="font-size: 80px;"></i>
                    <h5 class="mt-3">Add Categories</h5>
                </div>
            </a>
        </div>
        
        <!-- Upload Magazine -->
        <div class="col-6 col-md-4">
            <a href="<?= base_url('admin/uploadMagazine') ?>" class="text-decoration-none">
                <div class="p-4 border rounded shadow-sm bg-light h-100">
                    <i class="ti ti-alert-circle" style="font-size: 80px;"></i>
                    <h5 class="mt-3">Upload Magazine</h5>
                </div>
            </a>
        </div>
        
        <!-- Manage Magazines -->
        <div class="col-6 col-md-4">
            <a href="<?= base_url('admin/magazines') ?>" class="text-decoration-none">
                <div class="p-4 border rounded shadow-sm bg-light h-100">
                    <i class="ti ti-cards" style="font-size: 80px;"></i>
                    <h5 class="mt-3">Manage Magazines</h5>
                </div>
            </a>
        </div>
        
        <!-- Manage Users -->
        <div class="col-6 col-md-4">
            <a href="<?= base_url('admin/manageUsers') ?>" class="text-decoration-none">
                <div class="p-4 border rounded shadow-sm bg-light h-100">
                    <i class="ti ti-file-description" style="font-size: 80px;"></i>
                    <h5 class="mt-3">Manage Users</h5>
                </div>
            </a>
        </div>
        
        <!-- Subscriptions Plans -->
        <div class="col-6 col-md-4">
            <a href="<?= base_url('admin/manageSubscriptions') ?>" class="text-decoration-none">
                <div class="p-4 border rounded shadow-sm bg-light h-100">
                    <i class="ti ti-typography" style="font-size: 80px;"></i>
                    <h5 class="mt-3">Subscriptions Plans</h5>
                </div>
            </a>
        </div>
        
        <!-- Payment History -->
        <div class="col-6 col-md-4">
            <a href="<?= base_url('admin/payment-history') ?>" class="text-decoration-none">
                <div class="p-4 border rounded shadow-sm bg-light h-100">
                    <i class="ti ti-credit-card" style="font-size: 80px;"></i>
                    <h5 class="mt-3">Payment History</h5>
                </div>
            </a>
        </div>
        
        <!-- Logout -->
        <div class="col-6 col-md-4">
            <a href="<?= base_url('admin/logout') ?>" class="text-decoration-none">
                <div class="p-4 border rounded shadow-sm bg-light h-100">
                    <i class="ti ti-login" style="font-size: 80px;"></i>
                    <h5 class="mt-3">Logout</h5>
                </div>
            </a>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

