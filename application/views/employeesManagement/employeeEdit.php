<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_controller/session_expired');
    }
    ?>
    <p id="error"></p>
    <?php echo form_open('EmployeesManagement_controller/editEmployeeNotes'); ?>
    <fieldset class="center">
        <legend>עריכת העובד/ת <?php echo $employeeToEdit[0]['first_name'] . " " . $employeeToEdit[0]['last_name']; ?></legend>

        <input type="hidden" name="employee_number" id="employee_number" value="<?php echo $employeeToEdit[0]['user_number']; ?>">
        <div class="inputWrapper"><input class="formInput " type="text" id="new_id" name="new_id" value="<?php echo $employeeToEdit[0]['id']; ?>" required></div>
        <div class="inputWrapper"><input class="formInput " type="text" id="new_first_name" name="new_first_name" value="<?php echo $employeeToEdit[0]['first_name']; ?>" required></div>
        <div class="inputWrapper"><input class="formInput " type="text" id="new_last_name" name="new_last_name" value="<?php echo $employeeToEdit[0]['last_name']; ?>" required></div>
        <div><lable><b>סוג עובד: </b></lable><br><select id="new_etype" name="new_etype" size="1">
                <option value="<?php echo $employeeToEdit[0]['type']; ?>"><?php echo $employeeToEdit[0]['type']; ?></option>
                <option value="מלצר"> מלצר</option>
                <option value="ברמן"> ברמן</option>
                <option value="טבח"> טבח</option>    
            </select></div>
        <div class="inputWrapper"><input class="formInput " type="tel" id="new_phone" name="new_phone" value="<?php echo $employeeToEdit[0]['phone']; ?>" required></div>
        <div class="inputWrapper"><input id="empEdit" type="button" value="שמירה" name="submit" ></div>
    </fieldset>
    <?php echo form_close(); ?>

    <center><a href="#" id="newPassLink"> לחידוש סיסמת העובד/ת</a></center>
    
    <!-- Trigger the modal with a button -->    <button type="button" id="editEmpSuccessModal" class="btn btn-info btn-lg disableModalBtn" data-toggle="modal" data-target="#myModal" hidden="hidden"></button>

    <button type="button" id="editEmpSuccessModal" class="btn btn-info btn-lg disableModalBtn" data-toggle="modal" data-target="#myModal" hidden="hidden"></button>

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
                    <button type="button" class="btn btn-default btn-success" data-dismiss="modal" onclick="window.location.href = '<?php echo site_url('EmployeesManagement_controller/editEmployees'); ?>'"><b>אישור</b></button>
                </div>
            </div>

        </div>
    </div>
</main>
<script>

    $("#empEdit").click(function () {

        var employee_number = $("#employee_number").val();
        var new_id = $("#new_id").val();
        var new_first_name = $("#new_first_name").val();
        var new_last_name = $("#new_last_name").val();
        var new_etype = $("#new_etype").val();
        var new_phone = $("#new_phone").val();

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>" + "/EmployeesManagement_controller/editEmployeeNotes",
            data: {employee_number: employee_number, new_id: new_id, new_first_name: new_first_name, new_last_name: new_last_name, new_etype: new_etype, new_phone: new_phone},
            error: function () {
                alert('Something is wrong');
            },
            success: function (data) {
                if (data === "1") {
                    $('#editEmpSuccessModal').click();
                }
                else {
                    $("#error").html(data);
                }

            }

        });

    });

    $("#newPassLink").click(function () {
        window.location.href = "<?php echo site_url('EmployeesManagement_controller/editPassword?user_number=' . $employeeToEdit[0]['user_number']); ?>";

    });

</script>