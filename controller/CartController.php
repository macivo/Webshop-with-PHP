<?php
/**
 *  A spacial controller only for cart-system
 */
class CartController {
    /** observable for calling  */
    public function __construct() {
        if(isset($_POST['_add_to_cart'])) {
            $this->addToCart();
        }
    }

    /** Write the php $_POST to the session data */
    public function addToCart(){
        $product_in_cart = array(
            "product_id"=>$_POST['clicked_id'],
            "color_name"=>$_POST['clicked_color'],
            "memory"=>$_POST['clicked_memory'],
            "quantity"=>$_POST['clicked_quantity']
        );
        $position = array_search($_POST['clicked_id'], array_column($_SESSION['cart'], 'product_id'));
        if (gettype($position) === 'integer'){
            $_SESSION['cart'][$position]['quantity'] = $_SESSION['cart'][$position]['quantity'] + $_POST['clicked_quantity'];
        } else {
            $_SESSION['cart'][] = $product_in_cart;
        }
    }

    /** Give a list of items in the cart. Reading directly from session */
    public function getList(){
        $lists = array();
        $cart = $_SESSION['cart'];
        $count = 1;
        foreach ($cart as $product_in_cart) {
            $product = Product::getProductById($product_in_cart['product_id']);
            $option_color = Option::getOptionFromNameAndProductId($product_in_cart['color_name'],$product_in_cart['product_id']);
            $option_memory = Option::getOptionFromNameAndProductId($product_in_cart['memory'],$product_in_cart['product_id']);
            $quantity = $product_in_cart['quantity'];
            $price = $product[0]->getPrice()+$option_color[0]->getPrice()+$option_memory[0]->getPrice();
            $price = $price * $quantity;
            $list = array(
                'Product_id'=>$product[0]->getId(),
                'Pos.'=>$count,
                'Foto'=>$product[0]->getFoto(),
                'Product'=>$product[0]->getName(),
                'Color'=>$option_color[0]->getDes(),
                'Memory'=>$option_memory[0]->getDes(),
                'Quantity'=>$quantity,
                'Price'=>$price
            );
            $lists[] = $list;
            $count++;
        }
        return $lists;
    }

    /** Customer could remove the items from the cart too */
    public function removeFromCart($id){
        $temp = array();
        $position = array_search($id, array_column($_SESSION['cart'], 'product_id'));
        if (gettype($position) === 'integer'){
            unset($_SESSION['cart'][$position]);
            /** new Index assign for array in session */
            foreach ($_SESSION['cart'] as $item) {
                $temp[] = $item;
            }
            $_SESSION['cart'] = $temp;
        }
    }
}
