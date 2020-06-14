<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_controller/session_expired');
    }
    ?>
    <h3 class="title">סטטיסטיקות</h3>

    <div class="col-12 tab tabPay">
        <button class="tablinks active" onclick="openInfo(event, '30days')" id="defaultOpen">30 הימים האחרונים</button>
        <button class="tablinks " onclick="openInfo(event, 'year')">שנתי</button>
    </div>

    <!-- Tab content -->
    <div id="30days" class="col-11 tabcontent contentStatistics">
        <br><h4>נתוני ההכנסות של 30 הימים האחרונים</h4>
        <p>ממוצע ההכנסות ב- 30 הימים האחרונים:<b> <?php echo number_format((float) $avgIncomig30, 2, '.', '') . ' ש"ח'; ?></b></p>
        <center><div id="incomingchart30" class="charts"></div>
            <br><h4>סטטיסטיקת הרכישות על פי מחלקות </h4>
            <div id="piechart30" class="charts"></div></center><br>
        <div class="col-5 itemsList">
            <table class="table container cent">
                <h4>הכי פחות נמכרים</h4>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($leastSoldItems30 as $row) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row['item_name']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="col-5 itemsList">
            <table class="table container cent">
                <h4>הנמכרים ביותר</h4>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($mostSoldItems30 as $row) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row['item_name']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </div>

    <div id="year" class="col-11 tabcontent contentStatistics">
        <center><br><h4>נתוני ההכנסות של השנה האחרונה</h4>
            <p>ממוצע ההכנסות בשנה האחרונה:<b> <?php echo number_format((float) $avgIncomigYear, 2, '.', '') . ' ש"ח'; ?></b></p>
            <div id="incomingchartyear" class="charts"></div>
            <br><h4>סטטיסטיקת הרכישות על פי מחלקות </h4>
            <div id="piechartyear" class="charts"></div></center><br>
        <div class="col-5 itemsList">
            <table class="table container cent">
                <h4>הכי פחות נמכרים</h4>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($leastSoldItemsYear as $row) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row['item_name']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="col-5 itemsList">
            <table class="table container cent">
                <h4>הנמכרים ביותר</h4>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($mostSoldItemsYear as $row) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $row['item_name']; ?></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
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

<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['שם המחלקה', 'מספר הרכישות'],
<?php
foreach ($sectionPie30 as $static) {
    echo "['" . $static['section'] . " - " . $static['count(iteminorder.item_name)'] . "', " . $static['count(iteminorder.item_name)'] . "],";
}
?>
        ]);

        var options = {
            title: ' ',
            height: 250,
            width: 600,
            margin: 0,
            padding: 0,
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart30'));

        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['שם המחלקה', 'מספר הרכישות'],
<?php
foreach ($sectionPieYear as $static) {
    echo "['" . $static['section'] . " - " . $static['count(iteminorder.item_name)'] . "', " . $static['count(iteminorder.item_name)'] . "],";
}
?>
        ]);

        var options = {
            title: ' ',
            height: 250,
            width: 600,
            margin: 0,
            padding: 0,
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartyear'));

        chart.draw(data, options);
    }
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['תאריך', 'הכנסות'],
<?php foreach ($IncomingCahrt30 as $static) { ?>
                [' <?php
    $day = date_parse_from_format('Y-m-d', $static['CAST(time AS DATE)'])['day'];
    if ($day % 5 == 0) {
        echo $static['CAST(time AS DATE)'];
    } else {
        echo ' ';
    }
    ?>', <?php echo $static['sum(menu.price)']; ?> ],
<?php } ?>

        ]);

        var options = {
            title: '',
            width: 600,
            height: 250,
            hAxis: {titleTextStyle: {color: '#333'}},
            vAxis: {title: 'הכנסות', minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('incomingchart30'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['שנה', 'הכנסות'],
<?php foreach ($IncomingCahrtYear as $static) { ?>
                [' <?php
    $dt = DateTime::createFromFormat('!m', $static['month']);
    echo $dt->format('F');
    ?>', <?php echo $static['sum(menu.price)']; ?> ],
<?php } ?>

        ]);

        var options = {
            title: '',
            width: 600,
            height: 250,
            hAxis: {titleTextStyle: {color: '#333'}},
            vAxis: {title: 'הכנסות', minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('incomingchartyear'));
        chart.draw(data, options);
    }
</script>