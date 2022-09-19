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
    <!-- swalfire -->
    <?php
        if(session()->has('success')){
    ?>
        <script type="text/javascript">
            alert('<?= session('success')?>')
        </script>
    <?php
        }
        if(session()->has('invalid')){
        ?>
            <script type="text/javascript">
                alert('<?= session('invalid')?>')
            </script>
        <?php
        }
    ?>
    <div class="cards" style="text-align: center;">
        <hr>
        <h4>Available to clients</h4>
        <tr class="available-to-client" style="border: none;">
            <td>corn seed: 45</td>
            <td>corn seed: 47</td>
            <td>corn seed: 25</td>
            <td>corn seed: 5</td>
        </tr>
        <hr>
    </div>
    <h1>Add stocks (pop-up modal)</h1>
    <form action="" id="stock-form">
        <input type="text" name="category" placeholder="category" required>
        <input type="text" name="sub_category" placeholder="sub category" required>
        <h4>Stocks</h4>
        <label for="available">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required><br>
        <label for="available">Allocated:</label>
        <input type="number" name="allocated" id="allocated" required><br>
        <label for="available">Available for clients:</label>
        <input type="number" name="available" id="avail-c" value="" readonly><br>
        <label for="">Short Description:</label><br>
        <textarea name="des" id="" cols="30" rows="10"></textarea>

        <input type="submit" value="Add">
    </form>

    <div class="view-stocks" style="margin-top: 1rem;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Sub Cat.</th>
                    <th>Total Stocks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="stock-list">
                
            </tbody>
        </table>
    </div>

    <div class="update">

    </div>

    <script>
        $(() => {
            const url = document.querySelector("meta[name = base_url]").getAttribute("content");

            setInterval(function(){
                display_stock();
            }, 1000);

            var quantity
            var allocated

            $("#quantity, #allocated").on("keyup change", function () { 
                quantity = $('#quantity').val();
                allocated = $('#allocated').val();
                set_val();
            });

            function set_val(){
                return $('#avail-c').val(quantity - allocated)         
            }


            $('#stock-form').submit(function (e) { 
                e.preventDefault();
                console.log($(this).serialize())
                $.ajax({
                    type: "post",
                    url: `${url}/admin/dashboard/add-stock`,
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        console.log(response)
                    }
                });
            });

            function display_stock(){
                $.ajax({
                    type: "get",
                    url: `${url}/admin/dashboard/get-all-stocks`,
                    async: true,
                    success: function (response) {
                        $('.stock-list').html(response)

                        $('.show-update').click(function (e) { 
                            e.preventDefault();
                            var stock_id = $(this).attr('value');
                            $.ajax({
                                type: "get",
                                url: `${url}/admin/dashboard/get-a-stock/${stock_id}`,
                                async: true,
                                success: function (res) {
                                    $('.update').html(res)
                                }
                            });
                        });

                    }
                });
            }

            
        });
    </script>
</body>
</html>