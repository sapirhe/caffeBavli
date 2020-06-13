<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_Controller/session_expired');
    }
    echo form_open('MealManaging_controller/validateMailNotes'); ?>
    <fieldset class="center">
        <br><h3 class="title">לקוח/ה יקר/ה,<br> הזן/י את המייל למשלוח החשבונית </h3>
        <div class="inputWrapper"><input type="email" id="emailForReceipt" class="formInput" name="emailForReceipt" placeholder="example@gmail.com"></div>
        <div class="inputWrapper"><input id="sendReceipt" class="subBtn" type="button" value="שלח קבלה" name="sendReceipt" ></div>
    </fieldset>
    <?php echo form_close(); ?>
    <p id="error"></p>

    <!-- Trigger the modal with a button -->
    <button type="button" id="sendReceiptBtn" class="btn btn-info btn-lg disableModalBtn" data-toggle="modal" data-target="#myModal" hidden="hidden"></button>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title">אישור</h4></center>
                </div>
                <div class="modal-body">
                    <center><p>הקבלה נשלחה</p></center>
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirmBtn" class="btn btn-default btn-success" data-dismiss="modal"><b>אישור</b></button>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
    $("#sendReceipt").click(function () {

        var emailForReceipt = $("#emailForReceipt").val();
        var total = <?php echo $total; ?>;
        var order_number = <?php echo $order_number; ?>;
        var table_number = <?php echo $table_number; ?>;

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>" + "/MealManaging_controller/validateMailNotes",
            data: {emailForReceipt: emailForReceipt},
            error: function () {
                alert('Something is wrong');
            },
            success: function (data) {
                if (data === "1") {
                    $("#sendReceiptBtn").click();
                    $('#confirmBtn').on("click", function () {
                        window.location.href = '<?php echo site_url(); ?>' + '/MealManaging_controller/sendReceipt?emailForReceipt=' + emailForReceipt + '&total=' + total + '&order_number=' + order_number + '&table_number=' + table_number;
                    });
                }
                else {
                    $("#error").html(data);
                }

            }

        });

    });
</script>