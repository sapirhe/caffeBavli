<main>
    <p id="error"></p>
        <?php echo form_open('MenuEdit_controller/addItemNotes'); ?>
        <fieldset class="center">
            <legend>עריכת פריט</legend>
            <input type="hidden" name="c_item_name" id="c_item_name" value="<?php echo $itemToEdit[0]['item_name']; ?>">
            <div class="inputWrapper"><input class="formInput" value="<?php echo $itemToEdit[0]['item_name']; ?>" type="text" id="new_item_name" name="new_item_name" required></div>
            <div class="inputWrapper"><textarea col3="30" rows="3" class="formInput" id="new_description" name="new_description" ><?php echo $itemToEdit[0]['description']; ?></textarea></div>
            <div class="inputWrapper"><input class="formInput" value="<?php echo $itemToEdit[0]['price']; ?>" type="text" id="new_price" name="new_price" required></div>
            <div><lable>מבצע ההזמנה:  </lable><br><select id="new_execType" name="new_execType" size="1">
                    <option value="<?php echo $itemToEdit[0]['executer']; ?>"> <?php echo $itemToEdit[0]['executer']; ?></option>
                    <option value="ברמן"> ברמן</option>
                    <option value="טבח"> טבח</option>    
                </select></div>
            <div><lable>מחלקה:  </lable><br><select id="new_section" name="new_section" size="1">
                    <option value="<?php echo $itemToEdit[0]['section']; ?>"> <?php echo $itemToEdit[0]['section']; ?></option>
                    <option value="בוקר"> ארוחות בוקר</option>
                    <option value="טוסטים"> טוסטים</option>
                    <option value="כריכים"> כריכים</option>
                    <option value="סלטים"> סלטים</option>
                    <option value="צהריים"> ארוחות צהריים</option> 
                    <option value="קינוחים"> קינוחים</option>
                    <option value="שתיה"> שתיה</option>
                </select></div>
            <div class="inputWrapper"><input id="submitEditItem" class="submitBtn" type="button" value="עדכן" name="submitEditItem" ></div>
        <?php echo form_close(); ?>
</main>
<script>
     $("#submitEditItem").click(function () {

        var c_item_name = $("#c_item_name").val();
        var new_item_name = $("#new_item_name").val();
        var new_description = $("#new_description").val();
        var new_price = $("#new_price").val();
        var new_execType = $("#new_execType").val();
        var new_section = $("#new_section").val();
        
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>" + "/MenuEdit_controller/editItemNotes",
            data: {c_item_name: c_item_name, new_item_name: new_item_name, new_description: new_description, new_price: new_price, new_execType: new_execType, new_section: new_section},
            error: function () {
                alert('Something is wrong');
            },
            success: function (data) {
                if (data === "1") {
                    window.location.href = "<?php echo site_url('MenuEdit_controller/updateMenu'); ?>";
                }
                else {
                    $("#error").html(data);
                }

            }

        });

    });
    
</script>