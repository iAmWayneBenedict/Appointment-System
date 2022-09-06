<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>

<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>Employees</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard/') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Employees</li>
            </ol>
        </nav>
    </div>
    <button class="add-employee-btn btn btn-primary mb-5 center-vertical">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        <span class="ms-2">Add Employee</span>
    </button>
    <div style="width: 90%;">
        <table id="employees" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody class="list">
            </tbody>
        </table>
    </div>

    <div class="popup-overlay add-employee-con shadow-lg rounded-4">
        <div class="card border-0" style="width: 25rem;">
            <div class="card-body">
                <h5 class="mb-5">
                    <b>Add Employee</b>
                </h5>
                <form action="" method="post" id="form-add-employee" class="ml-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role">
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <input type="button" class="cancel-add-empoyee-btn btn mt-5 py-2" value="Cancel" />
                        <input type="submit" class="btn btn-primary mt-5 py-2 px-4" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="popup-overlay generated-qrcode-con shadow-lg rounded-4">
        <div class="card border-0" style="width: 25rem;">
            <div class="card-body d-flex flex-column gap-3">
                <h5 class="mb-5">
                    <b>Add Employee</b>
                </h5>
                <div id="qr-code"></div>
                <a hidden id='qrdl' class="btn btn-primary">Download</a>
                <button type="button" class="btn close-qr-generated">Close</button>
            </div>
        </div>
    </div>

</div>
<script src="<?= base_url("/src/js/qrcode.min.js") ?>"></script>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')

        // datatable initialization
        let $table = $('#employees').DataTable();

        $('.add-employee-btn').click(function(event) {
            $('.add-employee-con').addClass("active")
        })

        $('.cancel-add-empoyee-btn').click(function(event) {
            $('.add-employee-con').removeClass("active")
        })

        $('.close-qr-generated').click(function(event) {
            $('.generated-qrcode-con').removeClass("active")
        })
        $('#form-add-employee').submit(addEmployee)

        function addEmployee(event) {
            event.preventDefault()

            $('.cancel-add-empoyee-btn').click()

            $.ajax({
                type: "post",
                url: `${url}/add-employee`,
                data: {
                    name: $('#name').val(),
                    role: $('#role').val(),
                },
                dataType: "json",
                success: function(res) {
                    display_employees()
                }
            });
        }



        function display_employees() {
            // destroy table before updating
            $table.destroy()

            $.ajax({
                type: 'get',
                url: `${url}/get-employee`,
                async: true,
                success: function(response) {
                    $('.list').html(response);
                    $('.generate-qrcode-btn').each(function(index, element) {
                        $(this).click(function() {
                            $('.generated-qrcode-con').addClass('active')
                            const id = $(this).parent().parent().children()[0].textContent
                            const name = $(this).parent().parent().children()[1].textContent
                            let qrCodeData = JSON.stringify({
                                id,
                                name
                            });
                            generateQr(qrCodeData)
                            setTimeout(() => {
                                let qr = $("#qr-code").children('img').attr('src');
                                $('#qrdl').attr('href', qr);
                                $('#qrdl').attr('download', 'employee-qr-code.png');
                                $('#qrdl').removeAttr('hidden');
                            }, 500);
                        })
                    })

                    // after population of tbody
                    // datatable reinitialization
                    $table = $('#employees').DataTable({
                        "columnDefs": [{
                            "width": "30%",
                            "targets": 3
                        }]
                    });
                }
            });
        }
        display_employees()

        // generate qr code
        let qrForm = document.querySelector("form");
        let qrCode = new QRCode(document.getElementById("qr-code"));
        // qrForm.addEventListener("submit", generateQr);

        function generateQr(data) {
            event.preventDefault();
            qrCode.makeCode(data); // admin scan
        }
    })
</script>
<?= $this->endSection() ?>