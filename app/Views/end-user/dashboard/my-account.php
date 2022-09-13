<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <h3>My Account</h3>
    <!-- basic updates please put placeholer-->
    <form action="" method="post" id="acc-form">
        <input type="text" name="" id="" value="<?= $userData->code_id ?>" disabled><br>
        <input type="text" name="name" id="name" value="<?= $userData->name ?>"><br>
        <input type="text" name="address" id="address" value="<?= $userData->address ?>"><br>
        <input type="text" name="c_number" id="c_number" value="<?= $userData->contact_number ?>"><br>
        <input type="text" name="email" id="email" value="<?= $userData->email ?>"><br>
        <input type="text" name="social_pos" id="social_pos" value="<?= $userData->social_pos ?>"><br>
        <input type="submit" value="UPDATE">
    </form>
    <br>
    <h3>Change Password</h3>
    <!-- for password update -->
    <form action="" method="post" id="pass-form">
        <input type="password" name="o_password" id="o_password" placeholder="Old Password"><br>
        <input type="password" name="n_password" id="n_password" placeholder="New Password"><br>
        <input type="button" value="Show" id="show">
        <input type="submit" value="Change">
    </form>
    <script>
        $(() => {
            const base_url = document.querySelector("meta[name = base_url]").getAttribute('content');

            $('#show').click(function(e) {
                e.preventDefault();
                if ($('#o_password').attr('type') == 'text' && $('#n_password').attr('type') == 'text') {
                    $('#o_password').attr('type', 'password');
                    $('#n_password').attr('type', 'password');
                } else {
                    $('#o_password').attr('type', 'text');
                    $('#n_password').attr('type', 'text');
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
                        console.log(response) //this should ba an alert

                        if (response.code == 1 || response.code == 0) {
                            $(this).trigger('reset');
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
                            $(this).trigger('reset');
                        }
                    }
                });

            });

            $
        });
    </script>

    <?= $this->endSection() ?>