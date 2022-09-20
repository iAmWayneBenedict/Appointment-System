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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Appointment System | User</title>
</head>
<style>
    @media screen and (max-width: 900px) {

        .top-main-nav,
        .left-main-nav {
            display: none;
        }

        .main-content {
            padding: 1rem;
        }
    }
</style>
<body>
    <?php
        if(session()->has('invalid')){
    ?>
            <script type="text/javascript">
                alert('<?= session('invalid')?>')
                console.log('<?= session('invalid')?>')
            </script>
    <?php
        }
    ?>
    <nav class="container-fluid navbar bg-white px-5 top-main-nav">
        <div class="container-fluid flex justify-content-end">
            <div class="d-flex">
                <a href="#" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </a>
            </div>
            <a class="nav-link text-danger text-uppercase ms-3" style="font-weight: 700;" aria-current="page" href="<?= base_url('/user/dashboard/logout') ?>">Log out</a>
        </div>
    </nav>
    <aside class="left-main-nav">
        <div class="side-logo">
            <a href="<?= base_url("/") ?>" class="navbar-brand">
                <img src="<?= base_url('/src/img/Logo Center.svg') ?>" alt="">
            </a>
        </div>
        <div class="side-nav">
            <nav class="nav nav-pills flex-column gap-1">

                <a href="<?= base_url("/user/dashboard/set-appointment") ?>" class="add-appointment-btn btn btn-primary my-5 d-flex justify-content-md-center center-vertical flex-sm-fill mx-md-2" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Add appointment">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span class="ps-3 icon-label">Add Appointment</span>
                </a>

                <!-- Dashboard -->

                <a class="flex-sm-fill nav-link text-dark" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Dashboard" href="<?= base_url('/user/dashboard/') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span class="ps-3 icon-label">Dashboard</span>
                </a>

                <!-- My Account -->

                <a class="flex-sm-fill nav-link text-dark" href="<?= base_url("/user/my-account") ?>" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Profile">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="ps-3 icon-label">My Account</span>
                </a>

                <!-- Employees -->

                <a class="flex-sm-fill nav-link text-dark" href="<?= base_url("/user/dashboard/employee-status") ?>" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Employee Status">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="ps-3 icon-label">Employee Status</span>
                </a>
            </nav>
        </div>
    </aside>
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">

            <button class="btn navbar-toggler" id="side-nav-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <span class=""></span>
                <span class=""></span>
                <span class=""></span>
                <span class=""></span>
            </button>

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
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="<?= base_url('/user/dashboard') ?>">HOME</a>
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
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

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

            $('.side-nav nav .nav-link').each((index, el) => {
                if (window.location.href === el.href) {
                    el.classList.add("active")
                    el.classList.remove("text-dark")
                } else {
                    el.classList.remove("active")
                    el.classList.add("text-dark")
                }
            })
            let baseUrl = $('meta[name=base_url]').attr('content')
            window.onresize = function(event) {
                changeLogo()
            }
            changeLogo()

            function changeLogo() {
                if (this.innerWidth < 1400) {
                    $('.left-main-nav').children().find('img').attr('src', baseUrl + "/src/img/Bato (CS).png")
                } else {
                    $('.left-main-nav').children().find('img').attr('src', baseUrl + "/src/img/Logo Center.svg")
                }
            }

        })
    </script>
</body>

</html>