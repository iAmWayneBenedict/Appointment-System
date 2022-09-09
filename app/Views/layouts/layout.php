<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/src/css/app.css') ?>">
    <meta name="base_url" content="<?= base_url() ?>">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Appointment System</title>
</head>

<body>
    <nav class="container-fluid navbar bg-white px-5 nav-con">
        <div class="container-fluid">
            <a href="<?= base_url("/") ?>" class="navbar-brand">
                <img src="<?= base_url('/src/img/Logo Large.svg') ?>" alt="">
            </a>
            <div class="login-btn">
                <a href="<?= base_url("/user/login") ?>" class="btn">
                    <b>LOG IN</b>
                </a>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content') ?>

    <script type="module" src="<?= base_url('/src/js/app.js') ?>"></script>
</body>

</html>