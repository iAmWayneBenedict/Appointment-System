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
    <link rel="icon" href="<?= base_url('/src/img/Bato (CS).png') ?>">
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
    if (session()->has('invalid')) {
    ?>
        <script type="text/javascript">
            Swal.fire(
                'Warning!',
                '<?= session('invalid') ?>',
                'warning'
            )
        </script>
    <?php
    }
    if (session()->has('success')) {
    ?>
        <script type="text/javascript">
            Swal.fire(
                '',
                '<?= session('success') ?>',
                'success'
            )
        </script>
    <?php
    }
    ?>

    <nav class="container-fluid navbar bg-white px-5 top-main-nav">
        <div class="container-fluid flex justify-content-end">
            <div class="d-flex">
                <a href="<?= base_url('/user/dashboard/notifications') ?>" class="btn">
                    <div class="position-relative" style="width: fit-content;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle bg-danger rounded-circle d-none notif-alert" style="padding:.35rem">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </div>
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

                <!-- Pending Appointment -->

                <a class="flex-sm-fill nav-link text-dark" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Pending Appointments" href="<?= base_url('/user/dashboard/pending-appointment/') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader">
                        <line x1="12" y1="2" x2="12" y2="6"></line>
                        <line x1="12" y1="18" x2="12" y2="22"></line>
                        <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                        <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                        <line x1="2" y1="12" x2="6" y2="12"></line>
                        <line x1="18" y1="12" x2="22" y2="12"></line>
                        <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                        <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                    </svg>
                    <span class="ps-3 icon-label">Pending Appointments</span>
                </a>

                <!-- Approved Appointment -->

                <a class="flex-sm-fill nav-link text-dark" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Approved Appointments" href="<?= base_url('/user/dashboard/approved-appointment/') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <span class="ps-3 icon-label">Approved Appointments</span>
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

                <!-- Stocks Monitor -->

                <a class="flex-sm-fill nav-link text-dark" href="<?= base_url("/user/dashboard/stocks-monitor") ?>" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="Employee Status">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                    <span class="ps-3 icon-label">Stocks Monitor</span>
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

            <a href="<?= base_url('/user/dashboard/notifications') ?>" class="btn">
                <div class="position-relative" style="width: fit-content;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    <span class="position-absolute top-0 start-100 translate-middle bg-danger rounded-circle d-none notif-alert" style="padding:.35rem">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </div>
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
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="<?= base_url("/user/my-account") ?>">My Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="<?= base_url('/user/dashboard/pending-appointment/') ?>">Pending Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="<?= base_url('/user/dashboard/approved-appointment/') ?>">Approved Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="<?= base_url('/user/dashboard/employee-status') ?>">Employee Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="<?= base_url('/user/dashboard/stocks-monitor') ?>">Stocks Monitor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark text-uppercase" style="font-weight: 700;" aria-current="page" href="<?= base_url('/user/dashboard/notifications') ?>">Notifications</a>
                    </li>
                    <li class="nav-item mt-5">
                        <a class="nav-link text-danger text-uppercase" style="font-weight: 700;" aria-current="page" href="<?= base_url('/user/dashboard/logout') ?>">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- preloader -->
    <?= view("components/preloader") ?>
    <?= $this->renderSection('content') ?>

    <script>
        $(() => {
           window.onbeforeunload = function(){
                
           }
           

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
            const url = document.querySelector("meta[name = base_url]").getAttribute("content");

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


            // get notifications 
            setInterval(() => {
                $.ajax({
                    type: "get",
                    url: `${url}/user/dashboard/get-notifications`,
                    dataType: "json",
                    success: function(response) {
                        let hasUnreadNotif = response.notifications.some((element) => parseInt(element.status) === 0)
                        if (hasUnreadNotif) {
                            $('.notif-alert').each(function() {
                                $(this).removeClass('d-none')
                            })
                        }
                    }
                });
            }, 5000)

            //update user's log time every 10 seconds
            setInterval(() => {
                $.ajax({
                    type: "GET",
                    url: `${url}/user/dashboard/online-stats`,
                    success: function (response) {
                        
                    }
                });
            }, 10000)


        })
    </script>
</body>

</html>