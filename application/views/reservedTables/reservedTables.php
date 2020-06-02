<main>

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
                            <td><button class="update" onclick="window.location.href = '<?php echo site_url() . "/ReservedTables_controller/editReservation?order_number=".$row['order_number'];?>'"></button></td>
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
    //   alert(<?php echo $pickedDate; ?>);
    //   document.getElementById('datePicker').valueAsDate = <?php echo date("d-m-Y"); ?>;

    function loadTablesList() {
        var date = $('#datePicker').val();
        window.location.href = '<?php echo site_url() . "/ReservedTables_controller/reservedTablesList?pickedDate="; ?>' + date;
    }

//    $("#sendDate").click(function () {
//
//        var date = $("#datePicker").val();
//
//        $.ajax({
//            type: 'POST',
//            url: "<?php echo site_url(); ?>" + "/ReservedTables_controller/reservedTablesListNotes",
//            data: {pickedDate: date},
//            error: function () {
//                alert('Something is wrong');
//            },
//            success: function (data) {
//                if (data !== "לא קיימות הזמנות במועד זה") {
//                    alert(data);
//                 //   $("#reservedTabelsList").html();
////                    for (var i = 0; i < data.length; i++) {
////                        jQuery('#reservedTabelsList').append(reservedTabelsList[i]);
////                    }
//                }
//                else {
//                    $("#error").html(data);
//                }
//
//            }
//
//        });
//
//    });
</script>