<?php
?>
    <h3>Inventory Status</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Sub Cat.</th>
                <th>Total Quantity</th>
                <th>Allocated</th>
                <th>Available</th>
                <th>Retail</th>
            </tr>
        </thead>
        <tbody class="results">
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
        <?php
            }
        ?>
        </tbody>
    </table>
    <hr>
    <h3>Claims Log Data</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Stock Name</th>
                <th>Claim By</th>
                <th>Quanity</th>
                <th>Date Claimed</th>
            </tr>
        </thead>
        <tbody class="results">
        <?php
            foreach($sresults as $result){
        ?>
            <tr>
                <td><?= $result['sub_category']?></td>
                <td><?= $result['avail_by'] ?></td>
                <td><?= $result['quantity_availed']?></td>
                <td><?= $result['date'] ?></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
<?php

?>