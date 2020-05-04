<main>
    <button class="proBtn" id="addNewEmp" onclick="addNewEmp()"><b>הוספת עובד חדש</b></button>
    <button class="proBtn" id="editEmp" onclick="editEmp()"><b>עריכת עובדים</b></button>

</main>
<script>
    function addNewEmp() {
        window.location.href = "<?php echo site_url('Login_controller/addNewEmployee'); ?>";
    }
    function editEmp() {
        window.location.href = "<?php echo site_url('EmployeesManagement_controller/editEmployees'); ?>";
    }
</script>