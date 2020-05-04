<main>
    <button class="proBtn" id="updateMenu" onclick="updateMenu()"><b>עדכון תפריט</b></button>
    <button class="proBtn" id="addItem" onclick="addItem()"><b>הוספת פריט</b></button>
    
</main>

<script>
    function updateMenu() {
        window.location.href = "<?php echo site_url('MenuEdit_controller/updateMenu'); ?>";
    }
   function addItem() {
        window.location.href = "<?php echo site_url('MenuEdit_controller/addItem'); ?>";
    }    
</script>