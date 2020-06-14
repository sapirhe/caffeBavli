<main>
    <?php
    if (!isset($_SESSION['id'])) {
        redirect('Pages_controller/session_expired');
    }
    ?>
    <h3 class="title">הזמנות להכנה</h3>

    <?php
    if ($user['user'][0]['type'] == "ברמן") {
        foreach ($barmanOrdersNumbers as $order) {
            ?>
            <div class="orderInfo">
                <hr class="linePrep">
                <h5 class="itemTitle"><?php echo "הזמנה מספר " . $order['order_number']; ?></h5>
                <div>
                    <?php
                    foreach ($barmanOrders as $item) {
                        if ($item['order_number'] == $order['order_number']) {
                            ?>
                            <p class="itemInfo"><?php
                                echo "<b>" . $item['item_name'] . "</b>";
                                if ($item['notes']) {
                                    echo " - " . $item['notes'];
                                }
                                ?></p>
                            <?php
                        }
                    }
                    ?>
                    <button class="orderComplete" onclick="orderComplete(<?php echo $order['order_number']; ?>)">בוצע</button>
                </div>
            </div>

            <?php
        }
    }
    ?>

    <?php
    if ($user['user'][0]['type'] == "טבח") {
        foreach ($shefOrdersNumbers as $order) {
            ?>
            <div class="orderInfo">
                <hr class="linePrep">
                <h5 class="itemTitle"><?php echo "הזמנה מספר " . $order['order_number']; ?></h5>
                <div>
                    <?php
                    foreach ($shefOrders as $item) {
                        if ($item['order_number'] == $order['order_number']) {
                            ?>
                            <p class="itemInfo"><?php
                                echo "<b>" . $item['item_name'] . "</b>";
                                if ($item['notes']) {
                                    echo " - " . $item['notes'];
                                }
                                ?></p>
                <?php
            }
        }
        ?>
                    <button class="orderComplete" onclick="orderComplete(<?php echo $order['order_number']; ?>)">בוצע</button>
                </div>
            </div>

        <?php
    }
}
?>



</main>
<script>
    function orderComplete(order_number) {
        window.location.href = '<?php echo site_url(); ?>/MealManaging_controller/orderComplete?order_number='+order_number+"'";

    }

</script>
<script type="text/javascript">    
    setInterval(function() {
                  window.location.reload();
                }, 60000); 
</script>











