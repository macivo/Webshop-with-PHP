<?php
    if (!isset($_SESSION)) {
        session_start();
    }
?>
<div>
    <?php
        require_once '../autoloader.php';
        $controller = new ShowController();
        $product = $controller->getProductShow();
        $name = $product->getName();
        $foto = $product->getFoto();
        $description = $product->getDescDe();
            if(isset($_SESSION['lang']) && $_SESSION['lang']==='en' ){
                $description = $product->getDescEn();
            }
        $price = $product->getPrice();
        echo '<p id="close" onclick="_close()">X</p>';
        echo '<h1 class=\'product_info_name\'>'.$name.'</h1>';
        echo '<img class=\'product_info_foto\' src=\'view/images/'.$foto.'.jpg\' alt=\'Products_Foto '.$foto.'\'>';
        $colors = $controller->getColorOptions();
        $memories = $controller->getMemoryOptions();
        echo '<div> <select id="color">';
        foreach ($colors as $option){
            $color = $option->getDes();
            $option_color_price = $option->getPrice();
            echo "<option onclick='_colorPrice(".$option_color_price.", ".$price.")'>".$color."</option>";
        }
        echo '</select>';
        echo '<select id="memory">';
        foreach ($memories as $option){
            $option_id = $option->getId();
            $mem = $option->getDes();
            $option_mem_price = $option->getPrice();
            echo "<option onclick='_memPrice(".$option_mem_price.", ".$price.")'>".$mem."</option>";
        }
        echo '</select> </div>';
        echo '<p class=\'product_info_des\'>'.$description.'</p>';
        echo '<p id=\'product_info_price\'>'.$price.'.- CHF</p>';
        echo '<input id="quantities" onchange="_quantityChange('.$price.')"type="number" min="1" max="10" value="1"/>';
        echo '<p style="color: red" id="info_add"></p>';
        echo '<button onclick="_addToBasket()" style="background: url(view/images/basket.jpg);background-size: cover; height: 5em; width: 5em" /></button>';

    ?>
</div>

