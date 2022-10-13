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

    <!-- add employee button -->

    <button class="add-employee-btn btn btn-primary mb-5 center-vertical">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        <span class="ms-2">Add Employee</span>
    </button>

    <!-- DataTable -->

    <div style="width: 90%;">
        <table id="employees" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody class="list">
                <!-- employee data insert here -->
            </tbody>
        </table>
    </div>

    <!-- add employee overlay -->
    <div class="popup-overlay add-employee-con shadow-lg rounded-4">
        <div class="card border-0" style="width: 25rem;">
            <div class="card-body">
                <h5 class="mb-5">
                    <b id="popup-overlay-title">Add Employee</b>
                </h5>
                <form action="" method="post" id="form-add-employee" class="ml-4">

                    <input type="hidden" id="id" name="id">
                    <!-- name -->

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>

                    <!-- Incharge to -->

                    <div class="incharge-con">
                        <div class="mb-3">
                            <label for="incharge_to" class="form-label">Incharge to</label>
                            <div class="d-flex gap-2 align-items-center">
                                <div class="position-relative flex-fill">
                                    <input type="text" class="form-control" id="incharge_to" name="incharge_to" placeholder="Incharge to" required>
                                    <div class="choose-designation" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </div>
                                </div>
                                <a class="btn btn-primary add-new-incharge">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- submit button -->

                    <div class="d-flex justify-content-end gap-3">
                        <input type="button" class="cancel-add-empoyee-btn btn mt-5 py-2" value="Cancel" />
                        <input type="submit" class="add-employee-submit-btn btn btn-primary mt-5 py-2 px-4" data-user-value="0" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- QR Code overlay -->

    <div class="popup-overlay generated-qrcode-con shadow-lg rounded-4">
        <div class="card border-0" style="width: 25rem;">
            <div class="card-body d-flex flex-column gap-3">
                <h5 class="mb-5">
                    <b>QR Code</b>
                </h5>
                <div id="qr-code" class="d-flex justify-content-center align-items-center mb-3">
                    <!-- qr code insert here -->
                </div>
                <!-- download qr code button -->
                <button type="button" id='qrdl' class="btn btn-primary">Download</button>
                <!-- hide overlay -->
                <button type="button" class="btn close-qr-generated">Close</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose Incharge to</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-group incharge-to-list-container">
                        <!-- list of incharge to insert here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-changes">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script src="<?= base_url("/src/js/qrcode.min.js") ?>"></script>
<script src="<?= base_url("/src/js/qr-code-styling.js") ?>"></script>
<script src="<?= base_url('/src/js/admin/admin-employees.js') ?>"></script>
<?= $this->endSection() ?>