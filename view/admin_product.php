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
            <th>Name</th>
            <th>Description_deutsch</th>
            <th>Description_english</th>
            <th>Manufacture</th>
            <th>Image</th>
            <th>Price</th>
            <th>Edit</th>
        </tr>
        <?php
        $products = Product::getProducts();
        foreach ($products as $product){
            echo '<tr>';
            echo '<td>'.$product->getId().'</td>';
            echo '<td>'.$product->getName().'</td>';
            echo '<td>'.$product->getDescDe().'</td>';
            echo '<td>'.$product->getDescEn().'</td>';
            echo '<td>'.$product->getManufacture().'</td>';
            echo '<td>'.$product->getFoto().'</td>';
            echo '<td>'.$product->getPrice().'</td>';
            $href = '\'index.php?action=admin_product_edit&id='.$product->getId().'\'';
            echo '<td><button onclick="location.href='.$href.'">'.$this->translator->getText("Edit").'</button></td>';
            echo '</tr>';
        }

        ?>

    </table>
    <?php
        echo '<hr>';
        $href = '\'index.php?action=admin_product_add\'';
        echo '<button class="checkout" onclick="location.href='.$href.'">'.$this->translator->getText("Add a new product").'</button>';
    ?>
</div>


