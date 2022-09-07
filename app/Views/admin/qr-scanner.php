<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>QR Scanner</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard') ?>">Dashboard</a></li>
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
                    $('#employees').DataTable();
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>