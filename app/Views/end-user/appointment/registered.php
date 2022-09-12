<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base_url" content="<?= base_url() ?>">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Appointment Prototype</title>
</head>
<body>
    <div class="main">
        <form action="" method="post" id="form-submit">
            <input type="text" name="name" value="<?= $userData->name; ?>" id="name" placeholder="Name" readonly><br>
            <input type="text" name="address" value="<?= $userData->address; ?>" id="address" placeholder="address"  readonly><br>
            <input type="text" name="c_number" value="<?= $userData->contact_number; ?>" id="c_number" placeholder="Contact Number"  readonly><br>
            <input type="text" name="social_pos" value="<?= $userData->social_pos; ?>" id="social_pos" placeholder="Social Position"  readonly><br>
            <select name="purpose" id="purpose">
                <option value="p1">P!</option>
                <option value="p2">p2</option>
                <option value="p3">p3</option>
                <option value="other">Other</option>
            </select><br>
            <textarea name="concern" id="concern" cols="30" rows="10" placeholder="Other Concerns" disabled></textarea><br>
            <input type="datetime-local" name="sched" id="sched">
            <input type="submit" value="SUBMIT">
        </form>
    </div>
    <script>
        $(()=> {
            const url = document.querySelector("meta[name = base_url]").getAttribute('content')

            $('#purpose').on('change keyup', function (e) { 
                if($(this).val() == 'other'){
                    $('#concern').prop('disabled', false);
                    return;                             
                }
                $('#concern').prop('disabled', true);
                return;
            });

            $('#form-submit').submit(function (e) { 
                e.preventDefault();
               

                const formdata = new FormData($(this)[0]);
                if($('#purpose').val() == 'other'){
                    formdata.set('purpose', $('#concern').val());
                    formdata.delete('concern')
                }
               
                const user_type = 001
                $.ajax({
                    type: "post",
                    url: `${url}/appointments/${user_type}/submit-appointment`,
                    data: formdata,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    success: function (response) {
                        if(response.code == 0){
                            console.log(response.errors);
                            return;
                        }

                        alert(response.msg)
                        console.log(response)
                    }
                });


                for( var val of formdata){
                    console.log(`${val[0]}: ${val[1]}`)
                }

            });
        });
    </script>
</body>
</html>