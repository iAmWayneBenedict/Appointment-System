<?php
$index = 0;
foreach ($user_data as $data) {
?>

    <div>
        <label for="user-contact-<?= $index ?>" style="cursor: pointer;">
            <span class="list-group-item list-group-item-action d-flex border-0 justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><?= $data['name'] ?></div>
                    <?= $data['contact_number'] ?>
                </div>
            </span>
        </label>
        <input type="radio" data-name="<?= $data['name'] ?>" data-number="<?= $data['contact_number'] ?>" hidden name="user-contact" id="user-contact-<?= $index ?>" class="user-contact">
    </div>

<?php
    $index++;
}
?>