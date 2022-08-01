<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS test</title>
</head>
<body>
    <form action="<?= base_url('/test-sms')?>" method="post">
        <input type="text" name="to_number" placeholder="+63 plus 10 digit number"><br>
        <textarea name="message" id="" cols="30" rows="10" placeholder="Message here">

        </textarea>
        <input type="submit" value="Send">
    </form>
</body>
</html>