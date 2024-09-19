<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Magazine</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
        }
        .btn-custom {
            width: 200px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="container text-center">
        <h1 class="mb-5">Welcome to Our Online Magazine</h1>
        <div class="d-grid gap-3 col-6 mx-auto">
            <a href="<?=base_url('user/home');?>" class="btn btn-primary btn-custom">Home</a>
            <a href="<?=base_url('user/register');?>" class="btn btn-success btn-custom">Register</a>
            <a href="<?=base_url('user/login');?>" class="btn btn-warning btn-custom">Login</a>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
