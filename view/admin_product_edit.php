<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="product_edit">
    <?php
    include "admin.php";
    if (empty($products)){
        echo "Product not found!!";
    }
    echo '<div class="edit_product">';
    $product = $products[0];
    echo '<form action="index.php?action=admin_product_edit&id='.$product->getId().'" method="post" >';

    echo '<hr><br>';
    echo '<p>ID</p>';
    echo '<p>'.$product->getId().'</p>';
    echo '<p>Name</p>';
    echo '<p><input name="name" value="'.$product->getName().'"/></p>';
    echo '<p>Description_deutsch</p>';
    echo '<textarea name="desc_de"> '.$product->getDescDe().'</textarea>';
    echo '<p>Description_english</p>';
    echo '<textarea name="desc_en"> '.$product->getDescEn().'</textarea>';
    echo '<p>Manufacture</p>';
    echo '<p><input name="manufacture" value="'.$product->getManufacture().'"/></p>';
    echo '<p>Image-Name</p>';
    echo '<p><input name="image" value="'.$product->getFoto().'"/></p>';
    echo '<p>Price</p>';
    echo '<p><input name="price" value="'.$product->getPrice().'"/></p>';
    echo '<p style="display: none"><input name="update_product" value="update"/></p>';
    echo '<input type="submit" value="UPDATE">';
    echo '</form></div><br><br>';

    $options = Option::getOptionById($product->getId());
    usort($options, function ($a, $b) {
        return strcmp($a->getType(), $b->getType());
    });

    echo '<div class="edit_option">';
    echo '<form action="index.php?action=admin_product_edit&id='.$product->getId().'" method="post" >';
    echo '<hr><br>';
    echo '<select size="10">';
    $init_price = $options[0]->getPrice();
    $init_id = $options[0]->getId();
    foreach ($options as $option){
        $price = $option->getPrice();
        echo '<option onclick="_setPrice('.$price.', '.$option->getId().')">'.$option->getDes().'</option>';
    }
    echo '</select>';
    echo '<br>';
    echo '<input id="price" name="price" value="'.$init_price.'"/>';
    echo '<input style="display: none" id="option_id" name="update_option" value="'.$init_id.'"/></p>';
    echo '<input type="submit" value="UPDATE OPTION">';
    echo '<hr><br>';
    echo '</form></div><br><br>';


    /** Add Option */
    echo '<div class="add_option">';
    echo '<form action="index.php?action=admin_product_edit&id='.$product->getId().'" method="post" >';
    echo '<p>'.$this->translator->getText('Type of option').'</p>';
    echo '<select name="type" size="1">';
    echo '<option value="color">Color</option>';
    echo '<option value="memory">Memory</option>';
    echo '</select>';
    echo '<p>'.$this->translator->getText('Value of option').'</p>';
    echo '<p><input name="option_des" /></p>';
    echo '<p>Price</p>';
    echo '<p><input name="price" /></p>';
    echo '<p style="display: none"><input name="add_option" value="option"/></p>';
    echo '<input type="submit" value="ADD OPTION">';
    echo '<hr><br>';
    echo '</form>';
    echo '</div>';
    ?>

    <a href="index.php?action=admin_product"><button> <?php echo $this->translator->getText("CANCEL"); ?> </button></a>
    <script>
        function _setPrice(price, id){
            document.getElementById("price").value = price;
            document.getElementById("option_id").value = id;
        }
    </script>

</div>

