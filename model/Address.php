<?php
/**
 * SQL Prepare
 * Actung define funktioniert nur mit double ""
 */
define("SELECT_ADDRESSES_ID","SELECT * FROM addresses WHERE user_id = ");
define("SELECT_ADDRESSES","SELECT * FROM addresses");
define("INSERT_ADDRESSES", "INSERT INTO addresses ");
class Address {

    private $id;
    private $user_id;
    private $firstname;
    private $lastname;
    private $street;
    private $zip;
    private $city;
    private $phonenumber;

    function __construct() { }
    /** Helper Function: Fetch the database response to this class */
    private static function fetch($response) {
        $addresses = array();
        if($response) {
            while ($address = $response->fetch_object(get_class())){
                $addresses[] = $address;
            }
        }
        return $addresses;
    }
    /** list all the addresses for Admin */
    public static function getAdresses() {
        $response = Database::doQuery(SELECT_ADDRESSES);
        return self::fetch($response);
    }
    /** Get addresses for an account */
    public static function getAdressesById() {
        $query =SELECT_ADDRESSES_ID.$_SESSION['user']['id'];
        $response = Database::doQuery($query);
        return self::fetch($response);
    }
    /** Add a address */
    public static function addAdresses($request){
        $userid = $_SESSION['user']['id'];
        $firstname = $request->getValue('firstname');
        $lastname = $request->getValue('lastname');
        $street = $request->getValue('street');
        $zip = $request->getValue('zip');
        $city = $request->getValue('city');
        $phonenumber = $request->getValue('phonenumber');
        $query = INSERT_ADDRESSES.'(user_id, firstname, lastname, street, zip, city, phonenumber)'.
            'VALUES ("'.$userid.'", "'.$firstname.'", "'.$lastname.'", "'.$street.'", "'.$zip.'", "'.$city.'", "'.$phonenumber.'")';
        Database::doQuery($query);
    }

    /**
     * Functions: Get
     */
    public function getId() {
        return $this->id;
    }
    public function getUserId() {
        return $this->user_id;
    }
    public function getFirstname() {
        return $this->firstname;
    }
    public function getLastname() {
        return $this->lastname;
    }
    public function getStreet() {
        return $this->street;
    }
    public function getZip() {
        return $this->zip;
    }
    public function getCity() {
        return $this->city;
    }
    public function getPhonenumber() {
        return $this->phonenumber;
    }
}