<main><br>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_Controller/session_expired');
    }
    echo form_open('EmployeesManagement_controller/editPasswordNotes'); ?>
    <fieldset class="center">
        <legend>חידוש הסיסמה של העובד/ת  <?php echo $employeeToEdit[0]['first_name'] . " " . $employeeToEdit[0]['last_name']; ?></legend>

        <input type="hidden" name="employee_number" id="employee_number" value="<?php echo $employeeToEdit[0]['user_number']; ?>">
        <div class="inputWrapper"><input class="formInput" placeholder="סיסמה חדשה" type="password" id="new_password" name="new_password" maxlength="8" onkeyup="check()" required></div>
        <div class="inputWrapper"><input class="formInput" placeholder="אימות הסיסמה החדשה" type="password" id="new_passwordConf" name="new_passwordConf" maxlength="8" onkeyup="check()" required><span id='message'></span></div>        
        <div class="inputWrapper"><input id="passEdit" class="subBtn" type="button" value="שמירת הסיסמה" name="passEdit" ></div>

    </fieldset>
    <?php echo form_close(); ?>
    
    <!-- Trigger the modal with a button -->
    <button type="button" id="editPasswordSuccessModal" class="btn btn-info btn-lg disableModalBtn" data-toggle="modal" data-target="#myModal" hidden="hidden"></button>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title">אישור</h4></center>
                </div>
                <div class="modal-body">
                    <center><p>הסיסמה שונתה בהצלחה</p></center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-success" data-dismiss="modal" onclick="window.location.href = '<?php echo site_url('EmployeesManagement_controller/editEmployees'); ?>'"><b>אישור</b></button>
                </div>
            </div>

        </div>
    </div>
</main>

<script>
    $("#passEdit").click(function () {
        var employee_number = $("#employee_number").val();
        var new_password = $("#new_password").val();
        var new_passwordConf = $("#new_passwordConf").val();

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>" + "/EmployeesManagement_controller/editPasswordNotes",
            data: {employee_number: employee_number, new_password: new_password, new_passwordConf: new_passwordConf},
            error: function () {
                alert('Something is wrong');
            },
            success: function (data) {
                if (data === "1") {
                    $('#editPasswordSuccessModal').click();
                }
                else {
                    $("#error").html(data);
                }

            }

        });
    });

    var check = function () {
        if (document.getElementById('new_password').value ==
                document.getElementById('new_passwordConf').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'סיסמה תואמת';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'סיסמה לא תואמת';
        }
    }
</script>