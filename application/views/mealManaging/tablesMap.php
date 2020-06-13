<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_Controller/session_expired');
    }
    ?>
    <div class="area">
        <h4>בפנים</h4>
        <?php foreach ($insideTables as $tbl) { ?>
        <button class="tblBtnSit <?php if($tbl['availability']=="תפוס"){echo "occupied";} ?>" onclick="window.location.href = '<?php echo site_url() . "/MealManaging_controller/takingOrder?table_number=" . $tbl['table_number']; ?>'"><?php echo $tbl['table_number']; ?></button>

        <?php }
        ?>
    </div>
    <div class="area">
        <h4>בחוץ</h4>
        <?php foreach ($outsideTables as $tbl) { ?>
            <button class="tblBtnSit <?php if($tbl['availability']=="תפוס"){echo "occupied";} ?>" onclick="window.location.href = '<?php echo site_url() . "/MealManaging_controller/takingOrder?table_number=" . $tbl['table_number']; ?>'"><?php echo $tbl['table_number']; ?></button>

        <?php }
        ?>
    </div>

</main>
