<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/src/css/app.css') ?>">
    <title>Appointment System</title>
</head>

<body>
    <nav class="container-fluid navbar bg-white px-5 nav-con">
        <div class="container-fluid">
            <a class="">
                <img src="<?= base_url('/src/img/Logo Large.svg') ?>" alt="">
            </a>
            <div class="login-btn">
                <button type="button" class="btn"><b>LOG IN</b></button>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content') ?>

    <script type="module" src="<?= base_url('/src/js/app.js') ?>"></script>
</body>

</html>