<?php
/**
 * SQL Prepare
 * Actung define funktioniert nur mit double ""
 */
define("SELECT_ORDER","SELECT * FROM orders ORDER BY id DESC LIMIT 30");
define("INSERT_ORDER", "INSERT INTO orders ");
class Order {
    private $id;
    private $order_number;
    private $user_id;
    private $address_id;
    private $product_id;
    private $option_color_id;
    private $option_ram_id;
    private $quantity;
    private $done;
    private $date;

    function __construct() { }
    /** Helper Function: Fetch the database response to this class */
    private static function fetch($response) {
        $orders = array();
        if($response) {
            while ($order = $response->fetch_object(get_class())){
                $orders[] = $order;
            }
        }
        return $orders;
    }

    public static function getOrder() {
        $response = Database::doQuery(SELECT_ORDER);
        return self::fetch($response);
    }

    public static function addOrder($request) {
        $user_id = $_SESSION['user']['id'];
        $address_id = $request->getValue('addressId');
        $cart = $_SESSION['cart'];
        foreach ($cart as $product_in_cart){
            $product_id = $product_in_cart['product_id'];
            $option_color_id = Option::getOptionFromNameAndProductId($product_in_cart['color_name'],$product_in_cart['product_id']);
            $option_ram_id = Option::getOptionFromNameAndProductId($product_in_cart['memory'],$product_in_cart['product_id']);
            $option_color_id = $option_color_id[0]->getId();
            $option_ram_id = $option_ram_id[0]->getId();
            $quantity = $product_in_cart['quantity'];
            $query = INSERT_ORDER.'(order_number, user_id, address_id, product_id, option_color_id, option_ram_id, quantity, done)'.
                ' VALUES ("'.$user_id.date(".Y.m.d.h.i.s").'", '.$user_id.', '.$address_id.', '.$product_id.', '.$option_color_id.', '.$option_ram_id.', '.$quantity.', "no")';
            Database::doQuery($query);
        }
        unset($_SESSION['cart']);
    }


    /**
     * Functions: Get
     */
    public function getId()
    {
        return $this->id;
    }
    public function getOrderNumber()
    {
        return $this->order_number;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getAddressId()
    {
        return $this->address_id;
    }
    public function getProductId()
    {
        return $this->product_id;
    }
    public function getOptionColorId()
    {
        return $this->option_color_id;
    }
    public function getOptionRamId()
    {
        return $this->option_ram_id;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function getDone()
    {
        return $this->done;
    }
    public function getDate()
    {
        return $this->date;
    }
}