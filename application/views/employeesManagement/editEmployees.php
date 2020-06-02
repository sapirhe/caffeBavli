<main>

    <h3 class="title">רשימת העובדים</h3>


    <div id="employeesList">
        <table class="table container cent">
            <tbody>
            <thead>
                <tr>
                    <th scope="col">מספר העובד</th>
                    <th scope="col">מספר ת.ז</th>
                    <th scope="col">שם פרטי</th>
                    <th scope="col">שם משפחה</th>
                    <th scope="col">טלפון</th>
                    <th scope="col">תפקיד</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($employees)) {
                    foreach ($employees as $row) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $row['user_number']; ?></th>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['first_name'] ?></td>
                            <td><?php echo $row['last_name'] ?></td>
                            <td><?php echo $row['phone'] ?></td>
                            <td><?php echo $row['type'] ?></td>
                            <td><button class="update" onclick="goToEditEmployee(<?php echo $row['user_number']; ?>)"></button></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
<script>
    function goToEditEmployee(user_number) {
        window.location.href = '<?php echo site_url(); ?>/EmployeesManagement_controller/employeeEdit?employee_number='+user_number+'';

    }
</script>