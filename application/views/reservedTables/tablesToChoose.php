<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_controller/session_expired');
    }
    ?>
    <h4 class="title">השולחנות הרלוונטיים</h4>
    <p id="error"></p>
    <div class="area" id="relevantTablesArea">
        <h4><?php echo "בחר/י מבין השולחנות הרלוונטיים " . $location; ?></h4>
        <?php
        $specificRelevantTables = array();
        $sameTimeRes = array();
        foreach ($same_time_res as $same) {
            array_push($sameTimeRes, $same['table_number']);
        }
        foreach ($relevant_tables as $tbl) {
            array_push($specificRelevantTables, $tbl['table_number']);
        }
        $releventTables = array_diff($specificRelevantTables, $sameTimeRes);
        foreach ($releventTables as $tbl) {
            ?>
            <div class="input-radio"><input type="radio" class="tblBtn" id="<?php echo $tbl; ?>" name="tblBtn" value="<?php echo $tbl; ?>"> <label for="<?php echo $tbl; ?>"><?php echo $tbl; ?></label></div>
            <?php
        }
        ?>
    </div>
    <div class="inputWrapper"><label id="lblNotes"><b>הערות: </b></label><textarea col3="30" rows="3" class="formInput" placeholder="הקלד/י את הערתך" id="writeNotes" name="writeNotes"><?php
            if (isset($notes)) {
                echo $notes;
            }
            ?></textarea></div>
    <input type="button" value="שמור" id="saveReservationBtn" class="submitBtn">

    <!-- Trigger the modal with a button -->
    <button type="button" id="saveResSuccessModal" class="btn btn-info btn-lg disableModalBtn" data-toggle="modal" data-target="#myModal" hidden="hidden"></button>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title">אישור</h4></center>
                </div>
                <div class="modal-body">
                    <center><p>ההזמנה נשמרה</p></center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-success" data-dismiss="modal" onclick="window.location.href = '<?php echo site_url(); ?>/Pages_controller/HomePage'"><b>אישור</b></button>
                </div>
            </div>

        </div>
    </div>
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
                    $('#saveResSuccessModal').click();

                }
                else {
                    $("#error").html(data);
                }

            }

        });

    });
</script>