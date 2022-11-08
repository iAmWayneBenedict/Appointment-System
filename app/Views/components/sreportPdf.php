<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial|Helvetica">
    <style>
        * {
            box-sizing: border-box;
        }

        @page teacher {
            size: A4 portrait;
        }
        .content{
            page: teacher;
            font-family:  Arial, Helvetica, sans-serif;
            page-break-after: always; 
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
        .row1 table{
            table-layout: fixed;
        }
        .row1 #mid td{
            width: 25%;
           background-color: #d4dbd9;
        }
        .row1 #foot td{
            width: 25%;
           background-color: #d4dbd9;
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
            padding: 5px;
            font-size: 11px;
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

        .row1 #data th{
            background-color: #d9891a;
        }
        .date{
            font-size: 8px;
            text-align: right;
        }
        b{
            margin-left: 3px;
            margin-right: 8px;
        }
        .separator {
            border-top:  1px dashed #04AA6D !important;
        }
    </style>
</head>
<body>
    <div class="content">
    <div class="date">
        Date: <?= $date_today?>
    </div>
    <hr style="height: px; ">
    <div class="page container">
        <div class="header">
            <head>OFFICE OF THE MUNICIPAL AGRICULTURIST</head><br>
            <span>Stocks Report</span>
        </div>
    <hr style="margin-bottom: 10px;">
        <div class="main">
            <section class="row1">
                <h4>Inventory Status</h4>
                <table border="1" cellspacing="0" cellpadding="10" id="data">
                    <thead>
                        <tr>
                            <th><span>Sub Cat.</span></th>
                            <th><span>Total Quantity</span></th>
                            <th><span>Allocated</span></th>
                            <th><span>Available</span></th>
                            <th><span>Retail</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($stocks as $stock){
                    ?>
                        <tr>
                            <td><?= $stock['sub_category']?></td>
                            <td><?= $stock['total_quantity'] ?></td>
                            <td><?= $stock['allocated']?></td>
                            <td><?= $stock['available'] ?></td>
                            <td><?= $stock['per_type'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </section>
            <hr style="margin-top: 20px; border: 0.5px solid rgb(0,0,0, 0.5);">
            <section id="wrapper">
                <h4>Claims Log Data</h4>
                <table border="1" cellspacing="0" cellpadding="10" id="data">
                    <thead>
                        <tr>
                            <th><span>Stock Name</span></th>
                            <th><span>Claim By</span></th>
                            <th><span>Quantity availed</span></th>
                            <th><span>Date Claimed</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($sresults as $result){
                    ?>
                        <tr>
                            <td><?= $result['sub_category']?></td>
                            <td><?= $result['avail_by'] ?></td>
                            <td><?= $result['quantity_availed']?></td>
                            <td><?= $result['date'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </section> 
        </div>
    </div>
    </div>
</body>
</html>