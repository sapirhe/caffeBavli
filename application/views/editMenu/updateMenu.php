<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_controller/session_expired');
    }
    ?>
    <div class="col-md-2 tab">
        <button class="tablinks active" onclick="openInfo(event, 'breakfast')" id="defaultOpen">ארוחות בוקר</button>
        <button class="tablinks" onclick="openInfo(event, 'sandwiches')">כריכים</button>
        <button class="tablinks" onclick="openInfo(event, 'toasts')">טוסטים</button>
        <button class="tablinks" onclick="openInfo(event, 'salads')">סלטים</button>
        <button class="tablinks" onclick="openInfo(event, 'lunch')">ארוחות צהריים</button>
        <button class="tablinks" onclick="openInfo(event, 'deserts')">קינוחים</button>
        <button class="tablinks" onclick="openInfo(event, 'drinks')">שתיה</button>
    </div>

    <!-- Tab content -->
    <div id="breakfast" class="col-md-9 tabcontent">
        <h3>ארוחות בוקר</h3>

        <table class="table container">
            <thead>
                <tr>
                    <th scope="col">שם המנה</th>
                    <th scope="col">תיאור</th>
                    <th scope="col">מחיר</th>
                    <th scope="col">מבצע ההזמנה</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($breakfast as $row) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['item_name']; ?></th>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['executer']; ?></td>
                        <td><button class="update" onclick="update('<?php echo $row['item_name']; ?>')"></button></td>
                        <td><button class="remove" onclick="deleteItem('<?php echo $row['item_name']; ?>')"></button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div id="sandwiches" class="col-md-9 tabcontent">
        <h3>כריכים</h3>

        <table class="table container">
            <thead>
                <tr>
                    <th scope="col">שם המנה</th>
                    <th scope="col">תיאור</th>
                    <th scope="col">מחיר</th>
                    <th scope="col">מבצע ההזמנה</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($sandwiches as $row) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['item_name']; ?></th>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['executer']; ?></td>
                        <td><button class="update" onclick="update('<?php echo $row['item_name']; ?>')"></button></td>
                        <td><button class="remove" onclick="deleteItem('<?php echo $row['item_name']; ?>')"></button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div id="toasts" class="col-md-9 tabcontent">
        <h3>טוסטים</h3>

        <table class="table container">
            <thead>
                <tr>
                    <th scope="col">שם המנה</th>
                    <th scope="col">תיאור</th>
                    <th scope="col">מחיר</th>
                    <th scope="col">מבצע ההזמנה</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($toasts as $row) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['item_name']; ?></th>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['executer']; ?></td>
                        <td><button class="update" onclick="update('<?php echo $row['item_name']; ?>')"></button></td>
                        <td><button class="remove" onclick="deleteItem('<?php echo $row['item_name']; ?>')"></button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div id="salads" class="col-md-9 tabcontent">
        <h3>סלטים</h3>

        <table class="table container">
            <thead>
                <tr>
                    <th scope="col">שם המנה</th>
                    <th scope="col">תיאור</th>
                    <th scope="col">מחיר</th>
                    <th scope="col">מבצע ההזמנה</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($salads as $row) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['item_name']; ?></th>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['executer']; ?></td>
                        <td><button class="update" onclick="update('<?php echo $row['item_name']; ?>')"></button></td>
                        <td><button class="remove" onclick="deleteItem('<?php echo $row['item_name']; ?>')"></button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div id="lunch" class="col-md-9 tabcontent">
        <h3>ארוחות צהריים</h3>

        <table class="table container">
            <thead>
                <tr>
                    <th scope="col">שם המנה</th>
                    <th scope="col">תיאור</th>
                    <th scope="col">מחיר</th>
                    <th scope="col">מבצע ההזמנה</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($lunch as $row) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['item_name']; ?></th>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['executer']; ?></td>
                        <td><button class="update" onclick="update('<?php echo $row['item_name']; ?>')"></button></td>
                        <td><button class="remove" onclick="deleteItem('<?php echo $row['item_name']; ?>')"></button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div id="deserts" class="col-md-9 tabcontent">
        <h3>קינוחים</h3>

        <table class="table container">
            <thead>
                <tr>
                    <th scope="col">שם המנה</th>
                    <th scope="col">תיאור</th>
                    <th scope="col">מחיר</th>
                    <th scope="col">מבצע ההזמנה</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($deserts as $row) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['item_name']; ?></th>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['executer']; ?></td>
                        <td><button class="update" onclick="update('<?php echo $row['item_name']; ?>')"></button></td>
                        <td><button class="remove" onclick="deleteItem('<?php echo $row['item_name']; ?>')"></button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div id="drinks" class="col-md-9 tabcontent">
        <h3>שתיה</h3>

        <table class="table container">
            <thead>
                <tr>
                    <th scope="col">שם המנה</th>
                    <th scope="col">תיאור</th>
                    <th scope="col">מחיר</th>
                    <th scope="col">מבצע ההזמנה</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($drinks as $row) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $row['item_name']; ?></th>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['executer']; ?></td>
                        <td><button class="update" onclick="update('<?php echo $row['item_name']; ?>')"></button></td>
                        <td><button class="remove" onclick="deleteItem('<?php echo $row['item_name']; ?>')"></button></td>                 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


   <!-- Trigger the modal with a button -->
    <button type="button" id="deleteItemFromMenuBtn" class="btn btn-info btn-lg disableModalBtn" data-toggle="modal" data-target="#myModal" hidden="hidden"></button>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

         
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title">מחיקת פריט מהתפריט<h4></center>
                                </div>
                                <div class="modal-body">
                                    <p>האם ברצונך למחוק את הפריט מהתפריט?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="confirmDelete" class="btn btn-default btn-success" data-dismiss="modal"><b>אישור</b></button>
                                    <button type="button" id="cancelDelete" class="btn btn-default btn-danger" data-dismiss="modal"><b>ביטול</b></button>
                                </div>
                                </div>

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
    document.getElementById("defaultOpen").click();
</script>
<script>
    function deleteItem(item_name) {
        $('#deleteItemFromMenuBtn').click();
        $('#confirmDelete').on("click", function () {
              window.location.href = '<?php echo site_url(); ?>/MenuEdit_controller/deleteItem?item_name=' + item_name + "'";
         });
    }
    function update(item_name) {
        window.location.href = '<?php echo site_url(); ?>/MenuEdit_controller/editItem?item_name=' + item_name + "'";

    }
</script>