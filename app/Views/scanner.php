<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="base_url" content="<?= base_url() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <title>Document</title>
</head>
<body>
    <h2>Scanner Test</h2>
    <video id="preview"></video>
    <input type="text" class="data">
    <div class="employees">
        <table border="1">
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Status</td>
            </tr>
            <tbody class="list">

            </tbody>
        </table>
    </div>

<script type="text/javascript">
    $(document).ready(function () {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')
        const QR_scanner = new Instascan.Scanner({video: document.querySelector('#preview'), mirror: false});

        display_employees();
        setInterval(() => {
            display_employees();
        }, 1000)

        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                QR_scanner.start(cameras[1])
            }else{
                alert('No cameras found');
            }
        }).catch(function(e){
            console.error(e);
        });

        QR_scanner.addListener('scan', function(data){
            $('.data').val(data);
            $.ajax({
                type: "post",
                url: `${url}/track-employee`,
                data: {
                    emp_ID : data
                },
                dataType: "json",
                success: function (res) {
                    alert(res.msg)
                }
            });
        });

        function display_employees(){
            $.ajax({
                type: 'get',
                url: `${url}/get-employee`,
                async: true,
                success: function (response) {
                    $('.list').html(response);
                }
            });
        }
    });
</script>
</body>
</html>