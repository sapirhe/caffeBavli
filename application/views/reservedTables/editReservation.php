<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_controller/session_expired');
    }
    ?>
    <p id="error"></p>
    <?php echo form_open('ReservesTables_controller/editReservationNotes'); ?>
    <fieldset class="center">
        <legend>עריכת שריון שולחן</legend>
        <input type="hidden" name="order_number" id="order_number" value="<?php echo $order_number; ?>">
        <input type="hidden" name="order_notes" id="order_notes" value="<?php echo $order_info[0]['notes']; ?>">

        <div class="inputWrapper"><input class="formInput" placeholder="שם המזמין" type="text" id="new_diner_name" name="new_diner_name" value="<?php echo $order_info[0]['diner_name']; ?>" required></div>
        <div class="inputWrapper"><input class="formInput" placeholder="טלפון המזמין" type="number" id="new_diner_phone" name="new_diner_phone" value="<?php echo $order_info[0]['diner_phone']; ?>" required></div>
        <div class="inputWrapper"><input class="formInput" placeholder="תאריך להזמנה" type="date" id="new_order_date" name="new_order_date" value="<?php echo $order_info[0]['order_date']; ?>" required></div>
        <div class="inputWrapper"><input class="formInput" placeholder="שעת הזמנה" type="time" id="new_order_time" name="new_order_time" value="<?php echo $order_info[0]['order_time']; ?>" required></div>
        <div class="inputWrapper"><label><b>מספר סועדים:</b></label><input class="formInput" placeholder="מספר סועדים" type="number" id="new_diners_number" name="new_diners_number" value="<?php echo $order_info[0]['diners_number']; ?>" required></div>
        <div class="inputWrapper"><label><b>מספר השולחן:</b></label><input class="formInput" type="number" id="table_number" name="table_number" value="<?php echo $order_info[0]['table_number']; ?>" readonly></div>

        <?php $current_location = $order_info[0]['location']; ?>
        <input type="radio" id="outsideChoice" class="radioLocation" name="new_location" value="בחוץ" <?php if ($current_location == 'בחוץ') { ?> checked<?php } ?> ><label class="radioLabel">בחוץ</label>
        <input type="radio" id="insideChoice" class="radioLocation" name="new_location" value="בפנים" <?php if ($current_location == 'בפנים') { ?> checked<?php } ?>><label class="radioLabel">בפנים</label>

        <div class="inputWrapper"><input id="goToChooseTbl" class="submitBtn col-5" type="button" value="לבחירת שולחן חדש" name="submitItem" >
            <input id="submitNewReservation" class="submitBtn col-5" type="button" value="שמירת הנתונים כעת" name="submitItem" ></div>
    </fieldset>
    <?php echo form_close(); ?>

    <!-- Trigger the modal with a button -->
    <button type="button" id="editResSuccessModal" class="btn btn-info btn-lg disableModalBtn" data-toggle="modal" data-target="#myModal" hidden="hidden"></button>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title">אישור</h4></center>
                </div>
                <div class="modal-body">
                    <center><p>השינויים נשמרו בהצלחה</p></center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-success" data-dismiss="modal" onclick="window.location.href = '<?php echo site_url('ReservedTables_controller/reservedTablesList'); ?>'"><b>אישור</b></button>
                </div>
            </div>

        </div>
    </div>
</main>
<script>
    $("#submitNewReservation").click(function () {

        var order_number = $("#order_number").val();
        var new_diner_name = $("#new_diner_name").val();
        var new_diner_phone = $("#new_diner_phone").val();
        var new_order_date = $("#new_order_date").val();
        var new_order_time = $("#new_order_time").val();
        var new_diners_number = $("#new_diners_number").val();
        var new_location = document.querySelector('input[name="new_location"]:checked').value;

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>" + "/ReservedTables_controller/editResservationNotes",
            data: {new_diner_name: new_diner_name, new_diner_phone: new_diner_phone, new_order_date: new_order_date, new_order_time: new_order_time, new_diners_number: new_diners_number, new_location: new_location, order_number: order_number},
            error: function () {
                alert('Something is wrong');
            },
            success: function (data) {
                if (data === "1") {
                    $('#editResSuccessModal').click();
                }
                else {
                    $("#error").html(data);
                }

            }

        });

    });


    $("#goToChooseTbl").click(function () {

        var order_number = $("#order_number").val();
        var new_diner_name = $("#new_diner_name").val();
        var new_diner_phone = $("#new_diner_phone").val();
        var new_order_date = $("#new_order_date").val();
        var new_order_time = $("#new_order_time").val();
        var new_diners_number = $("#new_diners_number").val();
        var new_table_number = $("#table_number").val();
        var new_location = document.querySelector('input[name="new_location"]:checked').value;
        var notes = $("#order_notes").val();

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>" + "/ReservedTables_controller/editResservationNotes",
            data: {new_diner_name: new_diner_name, new_diner_phone: new_diner_phone, new_order_date: new_order_date, new_order_time: new_order_time, new_diners_number: new_diners_number, new_location: new_location, order_number: order_number},
            error: function () {
                alert('Something is wrong');
            },
            success: function (data) {
                if (data === "1") {
                    window.location.href = "<?php echo site_url(); ?>/ReservedTables_controller/tablesToChoose?reservation_number=" + order_number + "&location=" + new_location + "&diners_number=" + new_diners_number + "&currentTblNumber=" + new_table_number + "&notes=" + notes + "";
                }
                else {
                    $("#error").html(data);
                }

            }

        });

    });
</script>