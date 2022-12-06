<?php
/**
 * SQL Prepare
 * Actung define funktioniert nur mit double ""
 */
define("SELECT","SELECT * FROM products");
define("SELECT_ID","SELECT * FROM products WHERE id = ");
define("SELECT_MANU", "SELECT * FROM products WHERE manufacture = ");
define("UPDATE_PRODUCT", "UPDATE products SET ");
define("INSERT_PRODUCT", "INSERT INTO products ");
define("SELECT_LAST_PRODUCT", "SELECT * FROM products ORDER BY id DESC LIMIT 1");

class Product {
    private $id;
    private $name;
    private $desc_de;
    private $desc_en;
    private $manufacture;
    private $image;
    private $price;

    function __construct() { }
    /** Helper Function: Fetch the database response to this class */
    private static function fetch($response) {
        $products = array();
        if($response) {
            while ($product = $response->fetch_object(get_class())){
                $products[] = $product;
            }
        }
        return $products;
    }

    public static function getProducts() {
        $response = Database::doQuery(SELECT);
        return self::fetch($response);
    }

    public static function getProductById($id) {
        $response = Database::doQuery(SELECT_ID.(int)$id);
        return self::fetch($response);
    }

    public static function getProductByManufacture($manufacture) {
        $response = Database::doQuery(SELECT_MANU.$manufacture);
        return self::fetch($response);
    }
    public static function updateProduct($request){
        $id = $request->getValue('id');
        $name = $request->getValue('name');
        $desc_de = $request->getValue('desc_de');
        $desc_en = $request->getValue('desc_en');
        $manufacture = $request->getValue('manufacture');
        $image = $request->getValue('image');
        $price = $request->getValue('price');
        $query = 'name = "'.$name.'", desc_de = "'.$desc_de.'"
                , desc_en = "'.$desc_en.'", manufacture = "'.$manufacture.'", 
                image = "'.$image.'", price= "'.$price.'" WHERE products.id = '.$id;
        $query = UPDATE_PRODUCT.$query;
        Database::doQuery($query);
    }
    public static function addProduct($request){
        $name = $request->getValue('name');
        $desc_de = $request->getValue('desc_de');
        $desc_en = $request->getValue('desc_en');
        $manufacture = $request->getValue('manufacture');
        $image = $request->getValue('image');
        $price = $request->getValue('price');
        $query = INSERT_PRODUCT.
            '(name, desc_de, desc_en, manufacture, image, price) VALUES '.
            '("'.$name.'", "'.$desc_de.'", "'.$desc_en.'", "'.$manufacture.'", "'.$image.'", '.$price.')';
        echo $query;
        Database::doQuery($query);
        $product_id = self::fetch(Database::doQuery(SELECT_LAST_PRODUCT));
        $product_id = $product_id[0]->getId();
        $product_id = (int)$product_id;
        $product_id = $product_id+1;

        $option_color_des = $request->getValue('option_color_des');
        $option_color_price = $request->getValue('option_color_price');
        $newRequest = array();
        $newRequest['type'] = 'color';
        $newRequest['id'] = $product_id;
        $newRequest['option_des'] = $option_color_des;
        $newRequest['price'] = $option_color_price;
        Option::addOptionFromProduct($newRequest);

        $option_mem_des = $request->getValue('option_mem_des');
        $option_mem_price = $request->getValue('option_mem_price');
        $newRequest['type'] = 'memory';
        $newRequest['id'] = $product_id;
        $newRequest['option_des'] = $option_mem_des;
        $newRequest['price'] = $option_mem_price;
        Option::addOptionFromProduct($newRequest);
    }

    /**
     * Functions: Get
     */
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getDescDe() {
        return $this->desc_de;
    }
    public function getDescEn() {
        return $this->desc_en;
    }
    public function getManufacture() {
        return $this->manufacture;
    }
    public function getFoto() {
        return $this->image;
    }
    public function getPrice() {
        return $this->price;
    }
}
