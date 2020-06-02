<main>
        <p id="error"></p>
        <?php echo form_open('Login_controller/addNewEmployeeNotes'); ?>
        <fieldset class="center">
            <legend>הוספת עובד חדש</legend>
            <div class="inputWrapper"><input class="formInput addNewEmpInput" placeholder="תעודת זהות" type="text" id="id" name="id" required></div>
            <div class="inputWrapper"><input class="formInput addNewEmpInput" placeholder="שם פרטי" type="text" id="first_name" name="first_name" required></div>
            <div class="inputWrapper"><input class="formInput addNewEmpInput" placeholder="שם משפחה" type="text" id="last_name" name="last_name" required></div>
            <div><lable><b>סוג עובד: </b></lable><br><select id="etype" name="etype" size="1">
                    <option value="מלצר"> מלצר</option>
                    <option value="ברמן"> ברמן</option>
                    <option value="טבח"> טבח</option>    
                </select></div>
            <div class="inputWrapper"><input class="formInput addNewEmpInput" placeholder="סיסמה" type="password" id="password" name="password" maxlength="8" onkeyup="check()" required></div>
            <div class="inputWrapper"><input class="formInput addNewEmpInput" placeholder="אימות סיסמה" type="password" id="passwordConf" name="passwordConf" maxlength="8" onkeyup="check()" required><span id='message'></span></div>
            <div class="inputWrapper"><input class="formInput addNewEmpInput" placeholder="טלפון" type="tel" id="phone" name="phone" required></div>
            <div class="inputWrapper"><input id="addEmp" type="button" value="הוספה" name="submit" ></div>
        </fieldset>
        <?php echo form_close(); ?>
</main>

<script>
    var check = function () {
        if (document.getElementById('password').value ==
                document.getElementById('passwordConf').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'סיסמה תואמת';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'סיסמה לא תואמת';
        }
    }


    $("#addEmp").click(function () {

        var id = $("#id").val();
        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var etype = $("#etype").val();
        var password = $("#password").val();
        var passwordConf = $("#passwordConf").val();
        var phone = $("#phone").val();

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>" + "/Login_controller/addNewEmployeeNotes",
            data: {id: id, first_name: first_name, last_name: last_name, etype: etype, password: password, passwordConf: passwordConf,
                phone: phone},
            error: function () {
                alert('Something is wrong');
            },
            success: function (data) {
                if (data === "1") {
                    alert("ההוספה בוצעה בהצלחה");
                    window.location.href = "<?php echo site_url('Pages_controller/HomePage'); ?>";
                }
                else {
                    $("#error").html(data);
                }

            }

        });

    });
</script>