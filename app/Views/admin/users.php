<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>Users</h2>

        <!-- breadcrumbs -->
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
    </div>
    <!-- 
        users data
        DataTable implementation
     -->
    <div style="width: 90%;">
        <div class="users">
            <table id="users" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Code ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Identity</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $user['code_id'] ?></td>
                            <td><?= $user['fname'] ?></td>
                            <td><?= $user['lname'] ?></td>
                            <td><?= $user['address'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['social_pos'] ?></td>

                            <!-- remove user btn -->
                            <td>
                                <?php

                                if ($user['account_stats'] == 1) {
                                ?>

                                    <button type="button" class="btn btn-warning deactivate-user-btn" value="<?= $user['code_id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                        <span class="ms-2">DeActivate</span>
                                    </button>
                                <?php
                                } else {
                                ?>
                                    <button type="button" class="btn btn-success activate-user-btn" value="<?= $user['code_id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                        <span class="ms-2">Activate</span>
                                    </button>
                                <?php
                                }
                                ?>
                                <button type="button" class="btn btn-primary delete-user-btn" value="<?= $user['code_id'] ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    </svg>
                                    <span class="ms-2">Archive</span>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    //TODO: Update to server
    $(document).ready(function() {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')

        // DataTable initialization
        $('#users').DataTable();

        $('.deactivate-user-btn').click(handleDeactivateClick)
        $('.activate-user-btn').click(handleActivateClick)
        $('.delete-user-btn').click(handleDeleteClick)

        //perma delete
        function handleDeleteClick() {
            let id = $(this).val();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#d0d0d0d",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: `${url}/admin/dashboard/archive-user/${id}`,
                        // dataType: "json",
                        success: function(res) {
                            Swal.fire(
                                "Archive",
                                "Successfully move a user to archive",
                                "success"
                            );
                            location.reload()
                        },
                        error: function(err) {
                            console.error(err);
                        },
                    });
                }
            });
        }

        //Deactivate 
        function handleDeactivateClick() {
            let id = $(this).val();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#d0d0d0d",
                confirmButtonText: "Proceed",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: `${url}/admin/dashboard/deactivate-user/${id}`,
                        // dataType: "json",
                        success: function(res) {
                            Swal.fire(
                                "Deactivate",
                                "You have successfully deactivated a user",
                                "success"
                            );
                            location.reload()
                        },
                        error: function(err) {
                            console.error(err);
                        },
                    });
                }
            });
        }

        //Activate User
        function handleActivateClick() {
            let id = $(this).val();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#d0d0d0d",
                confirmButtonText: "Proceed",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: `${url}/admin/dashboard/reactivate-user/${id}`,
                        // dataType: "json",
                        success: function(res) {
                            Swal.fire(
                                "Activate",
                                "You have successfully Activated a user",
                                "success"
                            );
                            location.reload()
                        },
                        error: function(err) {
                            console.error(err);
                        },
                    });
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>