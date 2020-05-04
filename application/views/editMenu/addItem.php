<main>
    <p id="error"></p>
        <?php echo form_open('MenuEdit_controller/addItemNotes'); ?>
        <fieldset class="center">
            <legend>הוספת פריט לתפריט</legend>
            <div class="inputWrapper"><input class="formInput" placeholder="שם המנה" type="text" id="item_name" name="item_name" required></div>
            <div class="inputWrapper"><textarea col3="30" rows="3" class="formInput" placeholder="תיאור" id="description" name="description" ></textarea></div>
            <div class="inputWrapper"><input class="formInput" placeholder="מחיר" type="text" id="price" name="price" required></div>
            <div><lable>מבצע ההזמנה:  </lable><br><select id="execType" name="execType" size="1">
                    <option value="ברמן"> ברמן</option>
                    <option value="טבח"> טבח</option>    
                </select></div>
            <div><lable>מחלקה:  </lable><br><select id="section" name="section" size="1">
                    <option value="בוקר"> ארוחות בוקר</option>
                    <option value="טוסטים"> טוסטים</option>
                    <option value="כריכים"> כריכים</option>
                    <option value="סלטים"> סלטים</option>
                    <option value="צהריים"> ארוחות צהריים</option> 
                    <option value="קינוחים"> קינוחים</option>
                    <option value="שתיה"> שתיה</option>
                </select></div>
            <div class="inputWrapper"><input id="submitItem" class="submitBtn" type="button" value="הוספה" name="submitItem" ></div>
        <?php echo form_close(); ?>
</main>
<script>
     $("#submitItem").click(function () {

        var item_name = $("#item_name").val();
        var description = $("#description").val();
        var price = $("#price").val();
        var execType = $("#execType").val();
        var section = $("#section").val();
        
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url(); ?>" + "/MenuEdit_controller/addItemNotes",
            data: {item_name: item_name, description: description, price: price, execType: execType, section: section},
            error: function () {
                alert('Something is wrong');
            },
            success: function (data) {
                if (data === "1") {
                    alert("הפריט נוסף בהצלחה");
                    window.location.href = "<?php echo site_url('Pages_controller/editMenu'); ?>";
                }
                else {
                    $("#error").html(data);
                }

            }

        });

    });
    
</script>