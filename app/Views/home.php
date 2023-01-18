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
    <link rel="icon" href="<?= base_url('/src/img/Bato (CS).png') ?>">
    <title>Appointment System</title>
</head>

<body>
    <div class="center-con home-cover" style="background-image: url('<?= base_url('src/img/Bato_Municipal_HAll_WTR.webp') ?>')">
        <div class="position-absolute top-0 left-0 w-100" style="z-index: 100;">
            <div class="alert alert-warning alert-dismissible fade show text-center marquee" style="user-select: all;" role="alert">
                <p><strong>Holy guacamole!</strong> You should check in on some of those fields below.</p>
            </div>
        </div>
        <div class="card border-0 p-5" style="width: 30rem; z-index: 5;">
            <div class="card-body">
                <img src="<?= base_url('/src/img/Logo Center.svg') ?>" alt="">
                <div class="d-flex flex-column mt-5">

                    <!-- redirect to users login -->

                    <a href="<?= base_url("/user/login") ?>" class="btn btn-primary mt-3 rounded-5 py-2">User</a>

                    <!-- rediract to guest appointment registration -->

                    <a href="<?= base_url("/appointments/guest-user") ?>" class="btn btn-primary mt-3 rounded-5 py-2">Guest</a>

                    <!-- rediract to admin login -->
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="<?= base_url('/src/js/app.js') ?>"></script>
</body>

</html>