<?php
/**
 * SQL Prepare
 * Actung define funktioniert nur mit double ""
 */
define("SELECT_OPTION","SELECT * FROM options WHERE product_id = ");
define("SELECT_OPTION_WHERE","SELECT * FROM options WHERE ");
define("UPDATE_OPTION", "UPDATE options SET price = ");
define("INSERT_OPTION", "INSERT INTO options ");
class Option {
    private $id;
    private $product_id;
    private $type;
    private $option_des;
    private $price;

    function __construct() { }
    /** Helper Function: Fetch the database response to this class */
    private static function fetch($response) {
        $options = array();
        if($response) {
            while ($option = $response->fetch_object(get_class())){
                $options[] = $option;
            }
        }
        return $options;
    }
    /**
     * Search an products obtions by an id
     */
    public static function getOptionById($id) {
        $response = Database::doQuery(SELECT_OPTION.(int)$id);
        return self::fetch($response);
    }
    /**
     * Search an products obtions by product id and the name of option
     */
    public static function getOptionFromNameAndProductId($name, $id){
        $response = Database::doQuery(SELECT_OPTION_WHERE.
            'product_id = '.(int)$id.' AND option_des = "'.$name.'"');
        return self::fetch($response);
    }
    /**
     * Function: allow the correcting options details on database
     */
    public static function updateOption($request){
        $id = $request->getValue('update_option');
        $price = $request->getValue('price');
        $query = UPDATE_OPTION.'"'.$price.'"'.' WHERE options.id = '.$id;
        Database::doQuery($query);
    }
    /**
     * Function: allow the add an option to database
     */
    public static function addOption($request){
        $type = $request->getValue('type');
        $productId = $request->getValue('id');
        $option_des = $request->getValue('option_des');
        $price = $request->getValue('price');
        $query = INSERT_OPTION.'(product_id, type, option_des, price)'.
            'VALUES ("'.$productId.'", "'.$type.'", "'.$option_des.'", "'.$price.'")';
        echo $query;
        Database::doQuery($query);
    }
    /**
     * Function: allow the add an option, if a new products added
     */
    public static function addOptionFromProduct($request){
        $type = $request['type'];
        $productId = $request['id'];
        $option_des = $request['option_des'];
        $price = $request['price'];
        $query = INSERT_OPTION.'(product_id, type, option_des, price)'.
            'VALUES ("'.$productId.'", "'.$type.'", "'.$option_des.'", "'.$price.'")';
        echo $query;
        Database::doQuery($query);
    }

    /**
     * Functions: Get
     */
    public function getId(){
        return $this->id;
    }
    public function getDes(){
        return $this->option_des;
    }
    public function getType(){
        return $this->type;
    }
    public function getPrice(){
        return $this->price;
    }

}