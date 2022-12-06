<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div>
    <?php
    include "admin.php";
    ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Order Nr.</th>
            <th>User id</th>
            <th>Address id</th>
            <th>Product id</th>
            <th>Option color id</th>
            <th>Option ram id</th>
            <th>Quantity</th>
            <th>Done</th>
            <th>Date</th>
        </tr>
        <?php
        foreach ($orders as $order){
            echo '<tr>';
            echo '<td>'.$order->getId().'</td>';
            echo '<td>'.$order->getOrderNumber().'</td>';
            echo '<td>'.$order->getUserId().'</td>';
            echo '<td>'.$order->getAddressId().'</td>';
            echo '<td>'.$order->getProductId().'</td>';
            echo '<td>'.$order->getOptionColorId().'</td>';
            echo '<td>'.$order->getOptionRamId().'</td>';
            echo '<td>'.$order->getQuantity().'</td>';
            echo '<td>'.$order->getDone().'</td>';
            echo '<td>'.$order->getDate().'</td>';
            echo '</tr>';
        }

        ?>

    </table>
</div>