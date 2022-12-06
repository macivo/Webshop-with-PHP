<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="product_show_main">
        <?php
            echo "<div class='product_show'>";
            foreach ($products as $product) {
                $product_id = $product->getId();
                $product_foto = 'view/images/' . $product->getFoto() . ".jpg";
                $product_price_text = $this->translator->getText('Starting at a price of');
                $product_price = $product->getPrice();
                $product_name = $product->getName();
                $product_des = $product->getDescDe();
                if(isset($_SESSION['lang']) && $_SESSION['lang']==='en' ){
                    $product_des = $product->getDescEn();
                }
                echo "<div class='product' onclick='_showPopup(".$product_id.")'>";
                echo "<img class='product_img' src='$product_foto' alt='Products_Foto $product_foto'>";
                echo "<p class='product_name'>$product_name</p>";
                echo "<p class='product_price_text'>$product_price_text</p>";
                echo "<p class='product_price'>$product_price.- CHF</p>";
                echo "</div>";
            }
            echo "</div>";

        ?>
    <div id="modal">

        <!-- Modal content -->
        <div id="modal-content">
            <span class="close">&times;</span>
        </div>

    </div>
    <script type="text/javascript">
        let modal = document.getElementById("modal");
        let selected_id;
        let handy_price;
        let color_price = 0;
        let memory_price = 0;
        let quantity = 1;
        let sumPrice;


        function _showPopup(id) {
            selected_id = id;
            $.ajax({
                url: 'view/show_product.php',
                type: "POST",
                data: { clicked_id: id }
            }).done(function( msg ) {
                content.innerHTML = msg;
            });

			let content = document.getElementById("modal-content");
            modal.style.display = "block";

			content.innerHTML = " ";
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }

        function _close(){
                modal.style.display = "none";
        }

        function _colorPrice(price, h_price) {
            if(typeof handy_price === 'undefined') {
                handy_price = parseInt(h_price);
            }
            color_price = parseInt(price);
            _sumPrice();
        }
        function _memPrice(price, h_price) {
            if(typeof handy_price === 'undefined') {
                handy_price = parseInt(h_price);
            }
            memory_price = parseInt(price);
            _sumPrice();
        }

        function _sumPrice(){
            sumPrice = parseInt(handy_price+color_price+memory_price);
            sumPrice = parseInt(sumPrice)*parseInt(quantity);
            document.getElementById("product_info_price").innerHTML = sumPrice+".- CHF";
        }
        function _quantityChange(h_price) {
            if(typeof handy_price === 'undefined') {
                handy_price = parseInt(h_price);
            }
            quantity = parseInt(document.getElementById("quantities").value);
            _sumPrice();
        }

        function _addToBasket(){
            let color = document.getElementById("color").value;
            let memory = document.getElementById("memory").value;
            document.getElementById('info_add').innerHTML = "OK";

            setInterval(function() {
                document.getElementById('info_add').innerHTML = "";
            }, 2000);
            $.ajax({
                type: 'POST',
                url: 'view/cart.php',
                data: {
                    _add_to_cart: true,
                    clicked_id: selected_id,
                    clicked_color: color,
                    clicked_memory: memory,
                    clicked_quantity: quantity
                },
                success: function(data) {
                    console.log(data);
                },
                error: function(data) {
                    $('#info_add').innerHTML = "error please try again";
                }
            });
        }



    </script>

</div>

