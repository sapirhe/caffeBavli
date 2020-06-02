<main>
    <h4 class="title">השולחנות הרלוונטיים</h4>
    <p id="error"></p>
    <div class="area" id="relevantTablesArea">
        <h4><?php echo "בחר/י מבין השולחנות הרלוונטיים " . $location; ?></h4>
        <?php foreach ($relevant_tables as $tbl) { ?>
            <div class="input-radio"><input type="radio" class="tblBtn" id="<?php echo $tbl['table_number']; ?>" name="tblBtn" value="<?php echo $tbl['table_number']; ?>"> <label for="<?php echo $tbl['table_number']; ?>"><?php echo $tbl['table_number']; ?></label></div>

        <?php }
        ?>
    </div>
    <div class="inputWrapper"><label id="lblNotes"><b>הערות: </b></label><textarea col3="30" rows="3" class="formInput" placeholder="הקלד/י את הערתך" id="writeNotes" name="writeNotes"><?php if (isset($notes)){ echo $notes; }?></textarea></div>
    <input type="button" value="שמור" id="saveReservationBtn" class="submitBtn">


</main>
<script>
    function saveTableNumber(table_number) {
        document.getElementById("reservedTableNumber").value = table_number;
    }
    $('input[name="tblBtn"]:eq(0)').prop('checked', true);
    
    $("#saveReservationBtn").click(function () {

        var reservedTableNumber = document.querySelector('input[name="tblBtn"]:checked').value;
        var writeNotes = $("#writeNotes").val();
        var reservation_number = "<?= $reservation_number ?>";

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>" + "/ReservedTables_controller/tablesToChooseNotes",
            data: {reservedTableNumber: reservedTableNumber, writeNotes: writeNotes, reservation_number: reservation_number},
            error: function () {
                alert('Something is wrong');
            },
            success: function (data) {
                if (data === "ההזמנה בוצעה") {
                    alert(data);
                    window.location.href = "<?php echo site_url(); ?>/Pages_controller/HomePage";

                }
                else {
                    $("#error").html(data);
                }

            }

        });

    });
</script>