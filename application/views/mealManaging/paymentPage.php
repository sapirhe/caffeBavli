<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_Controller/session_expired');
    }
    ?>
    <div class="col-12 tab tabPay">
        <button class="tablinks active" onclick="openInfo(event, 'cash')" id="defaultOpen">מזומן</button>
        <button class="tablinks " onclick="openInfo(event, 'credit')">PayPal</button>
    </div>

    <!-- Tab content -->
    <div id="cash" class="col-11 tabcontent contentPay">
        <div id="payImg"></div>
        <div>

            <fieldset class="center">
                <div class="inputWrapper"><label class="payLbl">סה"כ: </label><input class="payInput" type="text" id="total_price" name="total_price" value="<?php echo $order_sum[0]['sum(price)']; ?>" readonly ></div>
                <div class="inputWrapper"><label class="payLbl"> סכום שהתקבל: </label><input class="payInput"  type="number" id="received_money" name="received_money" required></div>
                <button onclick="calc_change()" id="calcChange"> חשב עודף</button>
                <div class="inputWrapper"><label class="payLbl"> סך העודף: </label><input class="payInput" type="text" id="change" name="change" readonly></div>

                <div class="inputWrapper"><button id="cashPay" class="payBtn" onclick= "window.location.href = '<?php echo site_url() . "/MealManaging_controller/closingOrder?table_number=" . $table_number; ?>'">בצע תשלום</button></div>
                <a href="#" onclick="goToEmailForReceipt(<?php echo $order_sum[0]['sum(price)'].",".$table_number.",".$orderNumber; ?>)"><b>לשליחת חשבונית למייל הלקוח/ה</b></a>
            </fieldset>

        </div>

    </div>

    <div id="credit" class="col-11 tabcontent contentPay">
        <div id="creditImg"></div>
        <div class="center">
            <br><h5>לקוח יקר, סרוק את הברקוד לתשלום באמצעות PayPal</h5>
            <center><div id="qrcode"></div></center>
            <p id="showTotalPrice">סה"כ לתשלום: <?php echo $order_sum[0]['sum(price)']; ?> ש"ח</p>
            <div class="inputWrapper"><button class="payBtn" id="payPalPay" onclick= "window.location.href = '<?php echo site_url() . "/MealManaging_controller/closingOrder?table_number=" . $table_number; ?>'">בוצע</button></div>
            <a href="#" onclick="goToEmailForReceipt(<?php echo $order_sum[0]['sum(price)']; ?>)"><b>לשליחת חשבונית למייל הלקוח/ה</b></a>

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

    function calc_change()
    {
        var total_price = parseInt($("#total_price").val());
        var received_money = parseInt($("#received_money").val());
        var change = received_money - total_price;
        document.getElementById("change").value = change;
    }

    function goToEmailForReceipt(total, table_number, order_number) {
        window.location.href = '<?php echo site_url(); ?>/MealManaging_controller/getMailForReceipt?total=' + total + '&order_number='+ order_number +'&table_number='+table_number+'';
    }

</script>
<script src="<?php echo base_url(); ?>assets/js/qrcode.min.js"></script>
<script>
    var qrCodeData = "https://www.paypal.me/caffebavli/" + "<?php echo $order_sum[0]['sum(price)']; ?>";
    var qrCode = new QRCode("qrcode", {
        text: qrCodeData,
        width: 140,
        height: 140,
        correctLevel: QRCode.CorrectLevel.H
    });

</script>