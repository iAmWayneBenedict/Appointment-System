<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content mt-4">
    <div>
        <div class="pb-5">
            <h3 class="font-recoleta fw-bold">My Account</h3>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/user/dashboard/') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- basic updates please put placeholer-->
    <div class="d-flex flex-column flex-md-row me-md-4 mb-5">
        <div class="flex-fill me-md-3 me-lg-5" style="max-width: 40rem;">
            <form action="" method="post" id="acc-form">
                <div class="d-flex flex-column">
                    <h4 class="mb-4">Personal Information</h4>
                    <div class="pb-3">
                        <label for="user-id" class="form-label">User ID</label>
                        <input type="text" class="form-control" name="user-id" value="<?= $userData->code_id ?>" id="user-id" placeholder="User ID" disabled>
                    </div>
                    <div class="row pb-3">
                        <div class="form-group col-md-6">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="fname" value="<?= $userData->fname ?>" id="fname" placeholder="First Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lname" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="mname" value="<?= $userData->mname ?>" id="mname" placeholder="Middle Name">
                        </div>
                    </div>
                    <div class="pb-3">
                        <label for="mname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" value="<?= $userData->lname ?>" id="lname" placeholder="Last Name">
                    </div>
                    <div class="pb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?= $userData->address ?>" id="address" placeholder="Address">
                    </div>

                    <div class="pb-3">
                        <label for="c_number" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="c_number" value="<?= $userData->contact_number ?>" id="c_number" placeholder="Contact Number">
                    </div>
                    <div class="pb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="<?= $userData->email ?>" id="email" placeholder="Email">
                    </div>
                    <div class="pb-3">
                        <label for="social_pos" class="form-label">Social Position</label>
                        <input type="text" class="form-control" name="social_pos" value="<?= $userData->social_pos ?>" id="social_pos" placeholder="Social Position" readonly>
                    </div>
                    <input class="btn btn-primary mt-5" type="submit" value="UPDATE">
                </div>
            </form>
        </div>

        <div class="flex-fill mt-5 mt-md-0 ms-md-3 ms-lg-5" style="max-width: 40rem;">
            <!-- for password update -->
            <form action="" method="post" id="pass-form">
                <div class="d-flex flex-column">
                    <!-- password -->
                    <h4 class="mb-4">Change Password</h4>

                    <div class="mb-1">
                        <label for="o_password" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="o_password" name="o_password" placeholder="Old Password">
                        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                            message!</span><br>
                    </div>

                    <!-- confirm password -->

                    <div class="mb-1">
                        <label for="n_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="n_password" name="n_password" placeholder="New Password">
                        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                            message!</span><br>
                    </div>

                    <!-- show password -->

                    <div>
                        <input type="checkbox" name="show-password" id="show-password">
                        <label for="show-password">Show Password</label>
                    </div>
                    <input class="btn btn-primary mt-5" type="submit" value="Change">
                    <button class="btn btn-danger mt-5" id="delete">DELETE ACCOUNT</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(() => {
        const base_url = document.querySelector("meta[name = base_url]").getAttribute('content');

        $('#show-password').change(function(e) {
            e.preventDefault();
            if ($(this).is(':checked')) {
                $('#o_password').attr('type', 'text');
                $('#n_password').attr('type', 'text');
            } else {
                $('#o_password').attr('type', 'password');
                $('#n_password').attr('type', 'password');
            }
        });

        //ajax for main account(basic data)
        $('#acc-form').submit(function(e) {
            e.preventDefault();

            let formdata = $(this).serializeArray();

            $.ajax({
                type: "post",
                url: `${base_url}/user/my-account/update`,
                data: formdata,
                dataType: "json",
                success: function(response) {

                    //this should ba an aler
                    if (response.code == 1 || response.code == 0) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(_ => {
                            $(this).trigger('reset');
                            if (response.code == 1) {
                                location.reload();
                            }
                        })
                    }

                    if (response.code == 3) {
                        var msg = []; //hold all error messages
                        //loop error message and push to array
                        $.each(response.msg, function(key, val) {
                            msg.push(`${val}`)
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: msg.join('<br>'),
                        }) //sweet alert
                    }
                }
            });
        });

        //ajax for password
        $('#pass-form').submit(function(e) {
            e.preventDefault();

            let formdata = $(this).serializeArray();

            $.ajax({
                type: "post",
                url: `${base_url}/user/my-account/password-update`,
                data: formdata,
                dataType: "json",
                success: function(response) {
                    console.log(response) //this should ba an alert


                    if (response.code == 1 || response.code == 0) {
                        $('#o_password').val('');
                        $('#n_password').val('');
                        Swal.fire({
                            position: 'top-end',
                            icon: 'info',
                            title: response.msg,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }

                    if (response.code == 3) {
                        var msg = []; //hold all error messages
                        //loop error message and push to array
                        $.each(response.errors, function(key, val) {
                            msg.push(`${val}`)
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: msg.join('<br>'),
                        }) //sweet alert
                    }
                }
            });

        });

        $('#delete').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Account Deactivation',
                text: "Are you sure?!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "get",
                        url: `${base_url}/user/my-account/deactivate-account`,
                        dataType: 'json',
                        success: function(response) {
                            if (response.code == 0) {
                                Swal.fire(
                                    'Server Error!',
                                    response.msg,
                                    'error'
                                )
                            } else if (response.code == 1) {
                                Swal.fire(
                                    'DeActivated!',
                                    'You cannot access your account anymore.',
                                    'success'
                                ).then(() => {
                                    window.location.href = `${base_url}`
                                })
                            }
                        }
                    });

                }
            })
        });

        $
    });
</script>

<?= $this->endSection() ?>