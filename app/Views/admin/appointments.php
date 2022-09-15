<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/src/css/app.css') ?>">
    <meta name="base_url" content="<?= base_url() ?>">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
    <table id="pending">
        <tr>
            <th>ID</th>
            <th>User Type</th>
            <th>Schedule</th>
            <th>Date Created</th>
        </tr>
        <?php
            foreach($pending as $data){
        ?>
        <tr>
            <td><?= $data->user_type ?></td>
            <td><?= $data->schedule ?></td>
            <td><?= $data->date_created ?></td>
            <td><button class="rev" value="<?= $data->id ?>">Review</button></td>
        </tr>
        <?php
            }
        ?>

    </table>
    
    <div id="review">

    </div>

    <script>
        $(() => {
            const url = document.querySelector("meta[name = base_url]").getAttribute("content");

            $('.rev').click(function (e) { 
                e.preventDefault();
                let id = $(this).attr('value')
                $.ajax({
                    type: "get",
                    url: `${url}/admin/dashboard/${id}/review`,
                    success: function (response) {
                        $('#review').html(response)

                        $('.approve').click(function (e) { 
                            e.preventDefault();
                            $.ajax({
                                type: "post",
                                url: `${url}/admin/dashboard/approve`,
                                data: {
                                    id: id
                                },
                                dataType: "json",
                                success: function (res) {
                                    console.log(res)

                                    if(res.code == 0){
                                        alert(res.msg)
                                        return;
                                    }

                                    alert(res.msg)
                                    location.reload();//reload page after success

                                }
                            });
                        });

                        $('.reject').click(function (e) { 
                            e.preventDefault();
                            $.ajax({
                                type: "post",
                                url: `${url}/admin/dashboard/reject`,
                                data: {
                                    id: id
                                },
                                dataType: "json",
                                success: function (res) {
                                    console.log(res)

                                    if(res.code == 0){
                                        alert(res.msg)
                                        return;
                                    }

                                    alert(res.msg)
                                    location.reload();//reload page after success

                                }
                            });
                        });
                    }
                });

               
            });
        });
    </script>
</body>
</html>