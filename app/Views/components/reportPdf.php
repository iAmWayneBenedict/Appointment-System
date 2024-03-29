<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial|Helvetica">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
        Date: {date_today}
    </div>
    <hr style="height: px; ">
    <div class="page container">
        <div class="header">
            <head>OFFICE OF THE MUNICIPAL AGRICULTURIST</head><br>
            <span>Appointment Report</span>
        </div>
    <hr style="margin-bottom: 10px;">
        <div class="main">
            <section class="row1">
                {from_result}
                <table style="margin-bottom: 15px;">
                <tr>
                    <td colspan="6">Summary from Results : {all}</td>
                </tr>
                <tr id="foot" style="width: 100%;">
                    <td colspan="2">Pending Canceled <b>:</b> {pending_canceled}</td>
                    <td colspan="2">Approved Canceled<b>:</b> {approved_canceled}</td>
                    <td colspan="2">Passed<b>:</b> {pass}</td>
                </tr>
                <tr id="foot">   
                    <td colspan="2">Done <b>:</b> {done}</td>
                    <td colspan="2">Walkin <b>:</b> {walkin}</td>
                    <td colspan="2">Rejected <b>:</b> {reject}</td>
                </tr>
               </table>
               {/from_result}
            </section>
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
                    {results}
                        <tr>
                            <td>{schedule}</td>
                            <td>{name}</td>
                            <td>{social_pos}</td>
                            <td>{purpose}</td>
                            <td>{state}</td>
                        </tr>
                    {/results}
                    </tbody>
                </table>
            </section> 
            <section class="row1">
            
            <hr style="margin-top: 20px; border: 0.5px solid rgb(0,0,0, 0.5);">
            <table style="margin-top: 1px;">
                <tr>
                    <td colspan="6">All appointments made : {total_appointment}</td>
                </tr>
                {state}
                <tr id="mid" style="width: 100%;">
                    <td colspan="2">Pending Canceled <b>:</b> {pending_canceled} </td>
                    <td colspan="2">Approved Canceled<b>:</b> {approved_canceled}</td>
                    <td colspan="2">Passed<b>:</b> {pass}</td>
                </tr>
                <tr id="mid">   
                    <td colspan="2">Done <b>:</b> {done}</td>
                    <td colspan="2">Walkin <b>:</b> {walkin}</td>
                    <td colspan="2">Rejected <b>:</b> {reject}</td>
                </tr>
                {/state}
                </table>
            </section>
        </div>
    </div>
    </div>
</body>
</html>