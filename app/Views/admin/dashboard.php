<!-- admin/magazines.php -->
<?= $this->extend('admin/layouts/admin_layout') ?>

<?= $this->section('content') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="container ">
    <h2 class="text-center mb-4">Admin Dashboard</h2>
    
    <div class="row text-center g-4 mb-4">
        <!-- Total Sales -->
        <div class="col-md-4">
            <div class="p-4 border rounded shadow-sm bg-light h-100">
                <h5>Total Sales</h5>
                <p class="h2"><?= esc($total_sales) ?> INR</p>
            </div>
        </div>
        
        <!-- Total Users -->
        <div class="col-md-4">
            <div class="p-4 border rounded shadow-sm bg-light h-100">
                <h5>Total Users</h5>
                <p class="h2"><?= esc($total_users) ?></p>
            </div>
        </div>
        
        <!-- Monthly Sales -->
        <div class="col-md-4">
            <div class="p-4 border rounded shadow-sm bg-light h-100">
                <h5>This Month's Sales</h5>
                <p class="h2"><?= esc($monthly_sales) ?> INR</p>
            </div>
        </div>
    </div>
    <hr class="my-4">

    <div class="row mb-4">
        <div class="col-md-4">
            <h3>Total Sales Pie Chart</h3>
            <canvas id="totalSalesChart"></canvas>
        </div>
        <div class="col-md-4">
            <h3>Monthly Sales Pie Chart</h3>
            <canvas id="monthlySalesChart"></canvas>
        </div>
		
		<div class="col-md-4">
            
        </div>
    </div>
    
    <div class="row text-center g-4">
        <!-- Other sections... -->
    </div>
</div>

<script>
const totalSalesCtx = document.getElementById('totalSalesChart').getContext('2d');
const monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');

const totalSalesChart = new Chart(totalSalesCtx, {
    type: 'pie',
    data: {
        labels: ['Completed Sales', 'Pending Sales'],
        datasets: [{
            label: 'Total Sales',
            data: [<?= esc($total_sales) ?>, <?= esc($pending_sales) ?>], // Assuming you calculate pending sales
            backgroundColor: ['#36A2EB', '#FF6384'],
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Total Sales Distribution'
            }
        }
    }
});

const monthlySalesChart = new Chart(monthlySalesCtx, {
    type: 'pie',
    data: {
        labels: ['Completed Sales', 'Pending Sales'],
        datasets: [{
            label: 'Monthly Sales',
            data: [<?= esc($monthly_sales) ?>, <?= esc($pending_monthly_sales) ?>], // Calculate pending monthly sales
            backgroundColor: ['#36A2EB', '#FF6384'],
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Monthly Sales Distribution'
            }
        }
    }
});
</script>

<hr class="my-4">

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

