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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <link rel="icon" href="<?= base_url('/src/img/Bato (CS).png') ?>">

    <!-- specific version -->
    <script src="https://unpkg.com/bootstrap-modbox@1.6.2/dist/bootstrap-modbox.min.js"></script>
    <title>Appointment System | Admin</title>
</head>

<body>
    <?php
    if (session()->has('done')) {
    ?>
        <script>
            alert('<?= session('done') ?>')
        </script>
    <?php
    }
    ?>
    <nav class="container-fluid navbar bg-white px-5 top-main-nav">
        <div class="container-fluid flex justify-content-end">
            <div class="d-flex">
                <div class="d-flex">
                    <a href="<?= base_url('/admin/dashboard/notifications') ?>" class="btn">
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
                <a href="<?= base_url('admin/dashboard/logout') ?>" class="btn text-danger fw-bold">
                    LOGOUT
                </a>
            </div>
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

                <!-- Dashboard -->

                <a class="flex-sm-fill nav-link text-dark" aria-current="page" data-label href="<?= base_url('/admin/dashboard/') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span class="ps-3 icon-label">Dashboard</span>
                </a>

                <!-- Pending Appointments -->

                <a class="flex-sm-fill nav-link text-dark" href="<?= base_url('/admin/dashboard/pending-appointments') ?>">
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


                <!-- Approved Appointments -->

                <a class="flex-sm-fill nav-link text-dark" href="<?= base_url('/admin/dashboard/approved-appointments') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <span class="ps-3 icon-label">Approved Appointments</span>
                </a>

                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 'admin') { ?>

                    <!-- Users -->

                    <a class="flex-sm-fill nav-link text-dark" href="<?= base_url("/admin/dashboard/users") ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="ps-3 icon-label">Users</span>
                    </a>

                    <!-- Employees -->

                    <a class="flex-sm-fill nav-link text-dark" href="<?= base_url("/admin/dashboard/employees") ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="ps-3 icon-label">Employees</span>
                    </a>

                    <!-- Send Message -->

                    <a class="flex-sm-fill nav-link text-dark" href="<?= base_url('/admin/dashboard/send-message') ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <span class="ps-3 icon-label">Send Message</span>
                    </a>
                <?php } ?>

                <!-- Stocks Management -->

                <a class="flex-sm-fill nav-link text-dark" href="<?= base_url('/admin/dashboard/stock-management') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package">
                        <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                    <span class="ps-3 icon-label">Stocks Management</span>
                </a>

                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 'admin') { ?>
                    <a class="flex-sm-fill nav-link text-dark" href="<?= base_url('/admin/dashboard/report') ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="3" y1="9" x2="21" y2="9"></line>
                            <line x1="9" y1="21" x2="9" y2="9"></line>
                        </svg>
                        <span class="ps-3 icon-label">Generate Report</span>
                    </a>
                <?php } ?>
            </nav>
        </div>
    </aside>
    <!-- preloader -->
    <?= view("components/preloader") ?>
    <?= $this->renderSection('content') ?>


    <script>
        $(() => {
            const url = document.querySelector("meta[name = base_url]").getAttribute("content");
            let currentUrl = window.location.pathname.split('/')

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
                    url: `${url}/admin/dashboard/get-notifications`,
                    dataType: "json",
                    success: function(response) {
                        let hasUnreadNotif = response.notifications.some((element) => parseInt(element.is_read) === 0)
                        if (hasUnreadNotif) {
                            $('.notif-alert').each(function() {
                                $(this).removeClass('d-none')
                            })
                        }
                    }
                });
            }, 5000)
        })
    </script>
</body>

</html>