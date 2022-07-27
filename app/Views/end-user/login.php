<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>User Login</title>
</head>
<body>
    <?php
        if(session()->has('form-error')){
            foreach(session('form-error')->getErrors() as $error){ 
        ?>
            <div class="alert alert-danger m-1" role="alert">
                <?= $error; ?>
            </div>
        <?php
            }
        }
        else if(session()->has('invalid')){
        ?>
            <div class="alert alert-danger m-1" role="alert">
                <?= session('invalid'); ?>
            </div>
        <?php
        }
    ?>
    <h2>User Login Page</h2>
    <form action="<?= base_url('user/login-user')?>" method="post" id="form-login" class="ml-4">
        <input type="text" name="user_id" id="user_id" placeholder="User ID"><br>
        <input type="text" name="password" id="password" placeholder="Password"><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>