<?php
if (!isset($_SESSION)) {
    session_start();
}
if(isset($_POST['_add_to_cart'])) {
        require_once '../autoloader.php';
}
?>
<div>
    <?php
    $cartController = new CartController();
    if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        if(isset($_GET['ordered'])){
            echo '<h1 class="empty_cart">'.$this->translator->getText("Thank you for your order").'</h1>';
        }
        echo '<h1 class="empty_cart">'.$this->translator->getText("Cart is empty, please add some product").'</h1>';
    } else {
        $lists = $cartController->getList();
        echo '<hr id="top_table" class="top_table">';
        echo '<table>';
        echo '  <tr>
                <th>Pos.</th>
                <th>Product</th>
                <th>Color</th>
                <th>Memory</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>-</th>
                </tr>';
        $totalPrice = 0;
        foreach ($lists as $list){
            $totalPrice += $list['Price'];
            echo '<tr>';
            echo '<td>'.$list['Pos.'].'.</td>';
            echo '<td><div><img src="view/images/'.$list['Foto'].'.jpg" alt="Image" style="height: 5em"></img>';
            echo '<p>'.$list['Product'].'</p></div></td>';
            echo '<td>'.$list['Color'].'</td>';
            echo '<td>'.$list['Memory'].'</td>';
            echo '<td>'.$list['Quantity'].'</td>';
            echo '<td>'.$list['Price'].'.- CHF</td>';
            $href = '\'index.php?action=cart&remove='.$list['Product_id'].'\'';
            echo '<td ><button onclick="location.href='.$href.'" style="background: url(view/images/delete.png);background-size: cover; height: 2em; width: 2em;" /></button></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '<hr>';
        echo '<p class="total_price">Total: '.$totalPrice.'.- CHF</p>';
        echo '<hr>';
        echo '<a id="checkout" href="index.php?action=checkout"><button class="checkout">'.$this->translator->getText("CHECK OUT").'</button></a>';
    }
    ?>


</div>



