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
    <title>Appointment System | Admin</title>
</head>

<body>
    <nav class="container-fluid navbar bg-white px-5 top-main-nav">
        <div class="container-fluid flex justify-content-end">
            <div class="flex">
                <a href="#" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </a>
                <a href="#" class="btn">
                    <div class="img-profile-con">
                        <img src="<?= base_url("/src/img/pexels-tuấn-kiệt-jr-1382731.webp") ?>" alt="">
                    </div>
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
            <nav class="nav nav-pills flex-column gap-3">

                <!-- Dashboard -->

                <a class="flex-sm-fill nav-link text-dark" aria-current="page" data-label href="<?= base_url('/admin/dashboard') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span class="ps-3 icon-label">Dashboard</span>
                </a>

                <!-- QR Scanner -->

                <a class="flex-sm-fill nav-link text-dark" href="<?= base_url('/admin/qr-scanner') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                        <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z" />
                        <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z" />
                        <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z" />
                        <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z" />
                        <path d="M12 9h2V8h-2v1Z" />
                    </svg>
                    <span class="ps-3 icon-label">QR Scanner</span>
                </a>

                <!-- Users -->

                <a class="flex-sm-fill nav-link text-dark" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="ps-3 icon-label">Users</span>
                </a>

                <!-- Employees -->

                <a class="flex-sm-fill nav-link text-dark" href="<?= base_url("/admin/employees") ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span class="ps-3 icon-label">Employees</span>
                </a>

                <!-- Send Message -->

                <a class="flex-sm-fill nav-link text-dark" href="<?= base_url('/admin/send-message') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <span class="ps-3 icon-label">Send Message</span>
                </a>
            </nav>
        </div>
    </aside>

    <?= $this->renderSection('content') ?>


    <script>
        $(() => {
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
        })
    </script>
</body>

</html>