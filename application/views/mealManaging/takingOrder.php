<main>
    <div class="col-md-2 tab" id="menuTabs">
        <button class="tablinks active" onclick="openInfo(event, 'breakfast')" id="breakfastTab">ארוחות בוקר</button>
        <button class="tablinks" onclick="openInfo(event, 'sandwiches')" id="sandwichesTab">כריכים</button>
        <button class="tablinks" onclick="openInfo(event, 'toasts')" id="toastsTab">טוסטים</button>
        <button class="tablinks" onclick="openInfo(event, 'salads')" id="saladsTab">סלטים</button>
        <button class="tablinks" onclick="openInfo(event, 'lunch')" id="lunchTab">ארוחות צהריים</button>
        <button class="tablinks" onclick="openInfo(event, 'deserts')" id="desertsTab">קינוחים</button>
        <button class="tablinks" onclick="openInfo(event, 'drinks')" id="drinksTab">שתיה</button>
    </div>

    <!-- Tab content -->
    <div id="breakfast" class="col-5 tabcontent">
        <h3>ארוחות בוקר</h3>
        <?php foreach ($breakfast as $row) { ?>
            <button onclick="addToList('<?php echo $row['item_name']; ?>')" class="itemBtn"><?php echo $row['item_name']; ?></button>
        <?php } ?>

    </div>

    <div id="sandwiches" class="col-5 tabcontent">
        <h3>כריכים</h3>
        <?php foreach ($sandwiches as $row) { ?>
            <button onclick="addToList('<?php echo $row['item_name']; ?>')" class="itemBtn"><?php echo $row['item_name']; ?></button>
        <?php } ?>

    </div>

    <div id="toasts" class="col-5 tabcontent">
        <h3>טוסטים</h3>
        <?php foreach ($toasts as $row) { ?>
            <button onclick="addToList('<?php echo $row['item_name']; ?>')" class="itemBtn"><?php echo $row['item_name']; ?></button>
        <?php } ?>

    </div>

    <div id="salads" class="col-5 tabcontent">
        <h3>סלטים</h3>
        <?php foreach ($salads as $row) { ?>
            <button onclick="addToList('<?php echo $row['item_name']; ?>')" class="itemBtn"><?php echo $row['item_name']; ?></button>
        <?php } ?>

    </div>

    <div id="lunch" class="col-5 tabcontent">
        <h3>ארוחות צהריים</h3>
        <?php foreach ($lunch as $row) { ?>
            <button onclick="addToList('<?php echo $row['item_name']; ?>')" class="itemBtn"><?php echo $row['item_name']; ?></button>
        <?php } ?>

    </div>

    <div id="deserts" class="col-5 tabcontent">
        <h3>קינוחים</h3>
        <?php foreach ($deserts as $row) { ?>
            <button onclick="addToList('<?php echo $row['item_name']; ?>')" class="itemBtn"><?php echo $row['item_name']; ?></button>
        <?php } ?>

    </div>

    <div id="drinks" class="col-5 tabcontent">
        <h3>שתיה</h3>
        <?php foreach ($drinks as $row) { ?>
            <button onclick="addToList('<?php echo $row['item_name']; ?>')" class="itemBtn"><?php echo $row['item_name']; ?></button>
        <?php } ?>

    </div>




    <div id="orderItems" class="col-4">
        <h3>שולחן <?php echo $table_number; ?></h3>
        <p>מספר הזמנה: <?php echo $order_info[0]['order_number']; ?></p>
        <button id="clearTbl" onclick="window.location.href = '<?php echo site_url() . "/MealManaging_controller/clear?table_number=" . $table_number . "&order_number=" . $order_info[0]['order_number']; ?>'">נקה שולחן</button>
        <h4>פרטי ההזמנה</h4>
        <div id="list">
            <?php foreach ($items_in_order as $item) { ?>
                <div>
                    <button class='deleteFromOrder' id="<?php echo $item['item_number']; ?>"></button>
                    <p class='itemInOrderTxt'><?php echo $item['item_name']; ?></p>
                    <?php if ($item['notes'] != null) { ?>
                        <p class='notesForItem'><?php echo $item['notes']; ?></p>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
        <div id="totalPrice">סה"כ: <?php echo $orderSum[0]['sum(price)']; ?></div>
        <div class="buttonsOrder">
            <button class="orderBtn buttons" id="send" onclick="window.location.href = '<?php echo site_url() . "/MealManaging_controller/preparation?table_number=" . $table_number . "&order_number=" . $order_info[0]['order_number']; ?>'">שלח להכנה</button>
            <button class="orderBtn bottuns" id="pay" onclick="window.location.href = '<?php echo site_url() . "/MealManaging_controller/payment?table_number=" . $table_number . "&order_number=" . $order_info[0]['order_number']; ?>'">בצע תשלום</button>
        </div>

    </div>

</main>


<script>

    function openInfo(evt, tabName) {
        // Declare all variables
        var i, tabcontent, tablinks;
        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabName).style.display = "inline-block";
        evt.currentTarget.className += " active";
    }
</script>
<script>
    // Get the element with id="defaultOpen" and click on it
<?php if (isset($tab_id)) { ?>
        document.getElementById("<?php echo $tab_id; ?>").click();
<?php } ?>
</script>
<script>
    function addToList(item_name) {
        var notes = prompt("הערות:", "");
        var order_number =<?php echo $order_info[0]['order_number']; ?>;
        var tabId = $('#menuTabs').find('button.active').attr('id');

        $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>" + "/MealManaging_controller/saveOrder",
            data: {item_name: item_name, notes: notes, order_number: order_number, tab_id: tabId},
            error: function () {
                alert('Something is wrong');
            },
            success: function (data) {
                window.location.href = "<?php echo site_url(); ?>/MealManaging_controller/takingOrder?table_number=<?php echo $table_number; ?>&tab_id="+data+"";
                            }
                        });
                    }
</script>
<script>
    $(".deleteFromOrder").click(function () {
        deleteFromOrder($(this).attr("id"));
        $(this).next().remove();
        $(this).remove();
        
    });
    function deleteFromOrder(item_number_to_delete) {
        var r = confirm("להסיר את הפריט מההזמנה?");
        var tabId = $('#menuTabs').find('button.active').attr('id');
        if (r == true) {

            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>" + "/MealManaging_controller/deleteItemOrder",
                data: {item_number_to_delete: item_number_to_delete, tab_id: tabId},
                error: function () {
                    alert('Something is wrong');
                },
                success: function (data) {
                    window.location.href = "<?php echo site_url(); ?>/MealManaging_controller/takingOrder?table_number=<?php echo $table_number; ?>&tab_id="+data+"";
                                    }
                                });
                            }


                        }
</script>