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
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Appointment System | QR Scanner</title>
</head>

<body>

    <div class="m-5 qr-con">
        <div class="mt-3 mb-5">
            <h2>QR Scanner</h2>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard/') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">QR Scanner</li>
                </ol>
            </nav>
        </div>
        <div class="scanner-container">
            <video id="preview"></video>
            <input type="text" class="data my-3">
            <div class="employees">
                <table id="employees" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        $(document).ready(function() {
            const url = document.querySelector("meta[name = base_url]").getAttribute('content')
            const QR_scanner = new Instascan.Scanner({
                video: document.querySelector('#preview'),
                mirror: true
            });

            $(".qr-con").addClass("d-none")

            Swal.fire({
                title: 'Enter password',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                confirmButtonText: 'Login',
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    $.ajax({
                        type: "post",
                        url: `${url}/admin/verify-admin`,
                        data: {
                            password
                        },
                        async: true,
                        dataType: "json",
                        success: function(response) {
                            try {
                                if (response.status === "error") throw response.status
                                else {
                                    $(".qr-con").removeClass("d-none")
                                    $(".swal2-container").remove()
                                }
                            } catch (err) {
                                Swal.showValidationMessage(
                                    "Invalid password!"
                                )
                                return false;
                            }
                        },
                        error: function(err) {
                            console.error(err)
                        }
                    });

                    return false;
                },
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Verified"
                    })
                }
            })

            //auto update and display the employee and thier status
            display_employees();
            // setInterval(() => {
            //     display_employees();
            // }, 1000)

            Instascan.Camera.getCameras().then(function(cameras) {

                if (cameras.length > 0) {
                    QR_scanner.start(cameras[0])
                } else {
                    alert('No cameras found');
                }
            }).catch(function(e) {
                console.error(e);
            });

            QR_scanner.addListener('scan', function(data) {
                $('.data').val(parseInt(JSON.parse(data).id));
                $.ajax({
                    type: "post",
                    url: `${url}/track-employee`,
                    data: {
                        emp_ID: parseInt(JSON.parse(data).id)
                    },
                    dataType: "json",
                    success: function(res) {

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: res.msg
                        })

                        // update employees after scan
                        display_employees();
                    }
                });
            });

            function display_employees() {
                $.ajax({
                    type: 'get',
                    url: `${url}/get-employee-status`,
                    async: true,
                    success: function(response) {
                        $('.list').html(response);
                        // datatable initialization
                        // $('#employees').DataTable();
                    }
                });
            }
        });
    </script>

</body>

</html>