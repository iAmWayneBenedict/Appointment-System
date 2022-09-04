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
    <title>Appointment System</title>
</head>

<body>

    <div class="center-con home-cover">
        <div class="card border-0 p-5" style="width: 30rem; z-index: 5;">
            <div class="card-body">
                <img src="<?= base_url('/src/img/Logo Center.svg') ?>" alt="">
                <div class="d-flex flex-column mt-5">
                    <a href="<?= base_url("/user/login") ?>" class="btn btn-primary mt-3 rounded-5 py-2">User</a>
                    <a href="" class="btn btn-primary mt-3 rounded-5 py-2">Employee</a>
                    <a href="" class="btn btn-primary mt-3 rounded-5 py-2">Barangay Council</a>
                    <a href="" class="btn btn-primary mt-3 rounded-5 py-2">Admin</a>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="<?= base_url('/src/js/app.js') ?>"></script>
</body>

</html>