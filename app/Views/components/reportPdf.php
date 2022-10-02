<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        * {
            box-sizing: border-box;
        }
        body{
            font-family:  Arial, Helvetica, sans-serif;
        }
        .header {
            text-align: center; 
            font-weight: 100;
        }
        head{
            font-size: 22px;
            font-family:  Arial, Helvetica, sans-serif !important;
        }
        .header span{
            font-size: 15px;
            font-weight: lighter;
            text-transform: uppercase;
        }
        .row1{
            display: flex;
            flex-direction: row;
            font-size: 12px;
            flex-wrap: wrap;
        }
        .row1 > span {
            flex: 50%;
        }
        table{
            width: 100%;
        }
        #data {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #data td, #data th {
            border: 1px solid #ddd;
            padding: 6px;
            font-size: 10px;
        }

        #data tr:nth-child(even){background-color: #f2f2f2;}

        #data tr:hover {background-color: #ddd;}

        #data th {
            padding-top: 7px;
            padding-bottom: 7px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
        .date{
            font-size: 8px;
            text-align: right;
        }
    </style>
</head>
<body>
<div class="date">
        Date: <?= $date_today?>
    </div>
    <hr style="height: px; ">
    <div class="page container">
        <div class="header">
            <head>OFFICE OF THE MUNICIPAL AGRICULTURIST</head><br>
            <span>Appointment Report</span>
        </div>
        <div class="main">
            <section class="row1">
               <table>
               <tr>
                    <td>Overall Total of Appointments <b>:</b> <?= $total_appointment?></td>
                    <td align="right">Total Appointments From Result <b>:</b> <?= $from_result?></td>
                </tr>
               </table>
            </section>
            <hr>
            <section id="wrapper">
                <table border="1" cellspacing="0" cellpadding="10" id="data">
                    <thead>
                        <tr>
                            <th><span>Schedule</span></th>
                            <th><span>Client Name</span></th>
                            <th><span>Social Position</span></th>
                            <th><span>Purpose</span></th>
                            <th><span>State</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($results as $result){
                    ?>
                        <tr>
                            <td><?= $result['schedule']?></td>
                            <td><?= $result['name']?></td>
                            <td><?= $result['social_pos']?></td>
                            <td><?= $result['purpose']?></td>
                            <td><?= $result['state']?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </section> 
        </div>
    </div>
</body>
</html>