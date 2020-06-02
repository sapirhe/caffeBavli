<main>
    <?php if ($user['user'][0]['type'] != "מלצר") { 
        echo'<button id="prepOrd" class="proBtn" onclick="prepOrd()"><b> הזמנות להכנה</a></button>';} ?>
    <button class="proBtn" id="mealMng" onclick="mealMng()"><b>ניהול ארוחה</b></button>
    <button class="proBtn" id="saveTbl" onclick="saveTbl()"><b>שריון שולחן</b></button>
<button class="proBtn" id="resTbl" onclick="resTbl()"><b> שולחנות מוזמנים</b></button>
<?php if ($user['user'][0]['type'] != "מלצר") {
    echo '<button class="proBtn" id="empMng" onclick="empMng()"><b>ניהול העובדים</b></button>';} ?> 
<?php if ($user['user'][0]['type'] != "מלצר") {
    echo '<button class="proBtn" id="menuEdit" onclick="menuEdit()"><b>עריכת התפריט</b></button>';} ?> 
    <button class="proBtn" id="foodValueApi" onclick="foodValueApi()"><b> ערכים תזונתיים</b></button>
<?php if ($user['user'][0]['type'] != "מלצר") {
    echo '<button class="proBtn" id="statistics" onclick="statistics()"><b> סטטיסטיקות</b></button>';} ?> 
</main>



<script>
    function prepOrd() {
        window.location.href = "<?php echo site_url('MealManaging_controller/ordersToPreper'); ?>";
    }
    function mealMng() {
        window.location.href = "<?php echo site_url('MealManaging_controller/tablesMap'); ?>";
    }
    function saveTbl() {
        window.location.href = "<?php echo site_url('ReservedTables_controller/saveTable'); ?>";
    }
    function resTbl() {
        window.location.href = "<?php echo site_url('ReservedTables_controller/reservedTablesList'); ?>";
    }
    function empMng() {
        window.location.href = "<?php echo site_url('Pages_controller/employeesManagement'); ?>";
    }
    function menuEdit() {
        window.location.href = "<?php echo site_url('Pages_controller/editMenu'); ?>";
    }
    function foodValueApi() {
        window.location.href = "<?php echo site_url('Pages_controller/foodCalorieAPI'); ?>";
    }
    function statistics() {
        window.location.href = "<?php echo site_url('Pages_controller/statistics'); ?>";
    }
</script>