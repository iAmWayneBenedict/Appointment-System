<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>

<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>Pending Appointments</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard/') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pending Appointments</li>
            </ol>
        </nav>
    </div>
    <div class="mb-5" style="width: 90%;">
        <table class="table table-striped" data-paging="false" id=" pending">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User Type</th>
                    <th scope="col">Schedule</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pending as $data) {
                ?>
                    <tr>
                        <td><?= $data->id ?></td>
                        <td><?= $data->user_type ?></td>
                        <td><?= $data->schedule ?></td>
                        <td><?= $data->date_created ?></td>
                        <td>
                            <button type="button" class="rev btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" value="<?= $data->id ?>">
                                Review
                            </button>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>

        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 50%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="review">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute("content");

        // datatable initialization
        let $table = $("#pending").DataTable();

        $('.rev').click(function(e) {
            e.preventDefault();
            let id = $(this).attr('value')
            $.ajax({
                type: "get",
                url: `${url}/admin/dashboard/${id}/review`,
                success: function(response) {
                    $('#review').html(response)

                    $('.approve').click(function(e) {
                        e.preventDefault();
                        $.ajax({
                            type: "post",
                            url: `${url}/admin/dashboard/approve`,
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(res) {
                                console.log(res)

                                if (res.code == 0) {
                                    alert(res.msg)
                                    return;
                                }

                                Swal.fire({
                                    text: res.msg,
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload(); //reload page after success
                                    }
                                })

                            }
                        });
                    });

                    $('.reject').click(function(e) {
                        e.preventDefault();
                        $.ajax({
                            type: "post",
                            url: `${url}/admin/dashboard/reject`,
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(res) {
                                console.log(res)

                                if (res.code == 0) {
                                    alert(res.msg)
                                    return;
                                }

                                Swal.fire({
                                    text: res.msg,
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload(); //reload page after success
                                    }
                                })

                            }
                        });
                    });
                }
            });


        });
    });
</script>
<?= $this->endSection() ?>