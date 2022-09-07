<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base_url" content="<?= base_url() ?>">
    <link rel="stylesheet" href="<?= base_url('/src/css/app.css') ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <script type="module" src="<?= base_url('/src/js/app.js') ?>"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <title>Appointment System | User</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">

            <button class="btn navbar-toggler" id="side-nav-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="#">Hidden brand</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <a href="#" class="btn notification-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
            </a>
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="--bs-offcanvas-width: 100%;">
            <div class="offcanvas-header">
                <button type="button" class="btn-close side-nav-close-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                <a href="#" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </a>
            </div>
            <div class="offcanvas-body d-none">
                <ul class="nav align-items-center justify-content-center flex-column gap-2" style="margin-top: 20%;">
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="#">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="#">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="<?= base_url('/user/dashboard/employee-status') ?>">Employee Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="#">Notifications</a>
                    </li>
                    <li class="nav-item mt-5">
                        <a class="nav-link text-danger text-uppercase" style="font-weight: 700;" aria-current="page" href="<?= base_url('/user/dashboard/logout') ?>">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content') ?>


    <script>
        $(() => {
            let currentUrl = window.location.pathname.split('/')
            $("#side-nav-toggler").click(toggleSideNav)
            $(".side-nav-close-btn").click(toggleSideNav)

            function toggleSideNav(event) {
                setTimeout(() => {
                    if ($(".offcanvas").hasClass("show")) {
                        $(".offcanvas").children().last().removeClass("d-none")
                    } else {
                        $(".offcanvas").children().last().addClass("d-none")
                    }
                }, 500)
            }

        })
    </script>
</body>

</html>