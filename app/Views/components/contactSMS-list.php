
<?php

foreach($user_data as $data)
{
?>

    <div>
        <label for="user-contact-1" style="cursor: pointer;">
            <span class="list-group-item list-group-item-action d-flex border-0 justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><?= $data['name']?></div>
                    <?= $data['contact_number'] ?>
                </div>
            </span>
        </label>
        <input type="radio" data-name="John John" data-number="09123456789" hidden name="user-contact" id="user-contact-1" class="user-contact">
    </div>

<?php
}
?>