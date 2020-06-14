<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_controller/session_expired');
    }
    ?>
    <p id="error"></p>
    <?php echo form_open('ReservesTables_controller/saveTableNotes'); ?>
    <fieldset class="center">
        <legend>שריון שולחן</legend>
        <div class="inputWrapper"><input class="formInput" placeholder="שם המזמין" type="text" id="diner_name" name="diner_name" required></div>
        <div class="inputWrapper"><input class="formInput" placeholder="טלפון המזמין" type="number" id="diner_phone" name="diner_phone" required></div>
        <div class="inputWrapper"><input class="formInput" placeholder="תאריך להזמנה" type="date" id="order_date" name="order_date" required></div>
        <div class="inputWrapper"><input class="formInput" placeholder="שעת הזמנה" type="time" id="order_time" name="order_time" required></div>
        <div class="inputWrapper"><input class="formInput" placeholder="מספר סועדים" type="number" id="diners_number" name="diners_number" required></div>

        <input type="radio" id="outsideChoice" class="radioLocation" name="location" value="בחוץ" ><label class="radioLabel">בחוץ</label>
        <input type="radio" id="insideChoice" class="radioLocation" name="location" value="בפנים" ><label class="radioLabel">בפנים</label>

        <div class="inputWrapper"><input id="submitReservation" class="submitBtn" type="button" value="הבא" name="submitItem" ></div>
    </fieldset>
    <?php echo form_close(); ?>
</main>
<script>

    $("#submitReservation").click(function () {

        var diner_name = $("#diner_name").val();
        var diner_phone = $("#diner_phone").val();
        var order_date = $("#order_date").val();
        var order_time = $("#order_time").val();
        var diners_number = $("#diners_number").val();
        var location = document.querySelector('input[name="location"]:checked').value;


        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>" + "/ReservedTables_controller/saveTableNotes",
            data: {diner_name: diner_name, diner_phone: diner_phone, order_date: order_date, order_time: order_time, diners_number: diners_number, location: location},
            error: function () {
                alert('Something is wrong');
            },
            success: function (data) {
                if (isNaN(data) === false) {
                    window.location.href = "<?php echo site_url(); ?>/ReservedTables_controller/tablesToChoose?reservation_number=" + data + "&location=" + location + "&diners_number=" + diners_number + "";

                }
                else {
                    $("#error").html(data);
                }

            }

        });

    });

</script>