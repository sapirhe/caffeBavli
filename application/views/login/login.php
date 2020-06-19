<main>
    <i class="fa fa-user fa-5x icon sgnIcn"> </i>
    <p id="error"></p>
    <?php echo form_open('Login_controller/auth'); ?>
    <fieldset class="center" id="signInForm">
        <legend>התחבר כאן</legend>
        <div class="inputWrapper"><input class="formInput" id="id" placeholder="תעודת זהות" type="text" name="id"></div>
        <div class="inputWrapper"><input class="formInput" id="password" placeholder="סיסמה" type="password" name="password"></div>
        <div class="inputWrapper"><input id="signin" type="button" value="התחבר" name="signin">
    </fieldset>
    <?php echo form_close(); ?>

</main>
<script>
                $("#signin").click(function () {

                    var id = $("#id").val();
                    var password = $("#password").val();

                    $.ajax({
                        type: 'POST',
                        url: "<?php echo site_url(); ?>" + "/Login_controller/auth",
                        data: {id: id, password: password},
                        error: function () {
                            alert('Something is wrong');
                        },
                        success: function (data) {
                            if (data === "1") {
                                window.location.href = "<?php echo site_url('Pages_controller/HomePage'); ?>";
                            }
                            else {
                                $("#error").html(data);
                            }
                        }
                    });
                });
</script>



