<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="product_edit">
    <?php
    include "admin.php";
    echo '<div class="edit_product">';
    echo '<form onsubmit="_ok()" action="index.php?action=admin_product_add" method="post" >';
    echo '<h2>Product Name</h2>';
    echo '<p><input name="name"/></p>';
    echo '<p>Description_deutsch</p>';
    echo '<textarea name="desc_de"> </textarea>';
    echo '<p>Description_english</p>';
    echo '<textarea name="desc_en"> </textarea>';
    echo '<p>Manufacture</p>';
    echo '<p><input name="manufacture"/></p>';
    echo '<p>Image-Name</p>';
    echo '<p><input name="image"/></p>';
    echo '<p>Price</p>';
    echo '<p><input name="price"/></p>';
    echo '<h2>'.$this->translator->getText('Color').'</h2>';
    echo '<p><input name="option_color_des" /></p>';
    echo '<p>Price of color option</p>';
    echo '<p><input name="option_color_price" /></p>';
    echo '<h2>'.$this->translator->getText('Memory').'</h2>';
    echo '<p><input name="option_mem_des" /></p>';
    echo '<p>Price of memory option</p>';
    echo '<p><input name="option_mem_price" /></p>';
    echo '<p id="warning"></p>';
    echo '<input type="submit" name="addProduct" value="Add Products">';
    echo '</form></div>';
    echo '<a href="index.php?action=admin_product"><button>'.$this->translator->getText("CANCEL").'</button></a>';
    ?>
    <script>
        function _ok(){
            document.getElementById("warning").innerText = "OK";
        }
    </script>
</div>