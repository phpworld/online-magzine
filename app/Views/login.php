<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="<?=base_url();?>/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="<?=base_url();?>assets/css/styles.min.css" />
  <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 400px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
        .btn-primary {
            width: 100%;
        }
        .card {
            padding: 30px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
             <div class="container">
        <h2 class="text-center mb-4">Login</h2>
        <div class="card">
            <form action="<?= base_url('user/login') ?>" method="post">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?= old('email') ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div class="text-center mt-3">
            <p>Don't have an account? <a href="<?= base_url('user/register') ?>">Register here</a></p>
        </div>
        <div class="text-center mt-2">
            <p><a href="<?= base_url('user/forgot-password') ?>">Forgot your password?</a></p>
        </div>
    </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?=base_url();?>/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url();?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>