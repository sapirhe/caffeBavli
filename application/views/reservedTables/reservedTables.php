<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_Controller/session_expired');
    }
    ?>
    <fieldset class="center">
        <legend>השולחנות המשוריינים</legend><br>
        <div class="inputWrapper"><label><b>בחר/י את התאריך המבוקש:</b></label><input class="formInput" type="date" id="datePicker" name="datePicker" value="<?php echo $pickedDate; ?>" required></div>
        <div class="inputWrapper"><input id="sendDate" class="submitBtn" type="button" value="שלח" name="sendDate" onclick="loadTablesList()"></div>
    </fieldset>
    <?php echo form_close(); ?>
    <div id="reservedTabelsList">
        <table class="table container cent">
            <tbody>
                <?php
                if (!empty($reservedTablesByDate)) {
                    foreach ($reservedTablesByDate as $row) {
                        $time = $row['order_time'];
                        $time = substr($time, 0, 5);
                        ?>
                        <tr>
                            <th scope="row"><?php echo $time; ?></th>
                            <td><div><?php echo '<b>שם המזמין: </b>' . $row['diner_name'] . '<br><b>טלפון: </b>' . $row['diner_phone'] . '<br><b>מספר הסועדים: </b>' . $row['diners_number'] . '<br><b>מספר השולחן: </b>' . $row['table_number'] . ' - ' . $row['location'] . '<br><b>הערות: </b>' . $row['notes']; ?></div></td>
                            <td><button class="update" onclick="window.location.href = '<?php echo site_url() . "/ReservedTables_controller/editReservation?order_number=" . $row['order_number']; ?>'"></button></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <p id="error">
        <?php
        echo $notExist['message'];
        ?>
    </p>

</main>

<script>

    function loadTablesList() {
        var date = $('#datePicker').val();
        window.location.href = '<?php echo site_url() . "/ReservedTables_controller/reservedTablesList?pickedDate="; ?>' + date;
    }

</script>