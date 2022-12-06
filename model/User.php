<?php
/**
 * SQL Prepare
 * Actung define funktioniert nur mit double ""
 */
define("SELECT","SELECT * FROM users");
define("SELECT_ID","SELECT * FROM users WHERE id = ");
define("SELECT_NAME", "SELECT * FROM users WHERE username = ");
define("SELECT_PASS", "SELECT * FROM users WHERE password = ");
define("INSERT_USER","INSERT INTO users ");
define("UPDATE_USER", "UPDATE users SET ");

class User {
    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $email;
    private $password;
    private $function;

    //Private constructor to prevent class instances.
    function __construct() { }
    /** Helper Function: Fetch the database response to this class */
    private static function fetch($response) {
        $users = array();
        if($response) {
            while ($user = $response->fetch_object(get_class())){
                $users[] = $user;
            }
        }
        return $users;
    }
    /** List all user for Admin */
    public static function getUsers() {
        $response = Database::doQuery(SELECT);
        return self::fetch($response);
    }
    /** Search the user from users id */
    public static function getUserByID($id) {
        $response = Database::doQuery(SELECT_ID.(int)$id);
        return self::fetch($response);
    }
    /** Search the user from a username : ex. for login */
    public static function getUserByName($username) {
        $response = Database::doQuery(SELECT_NAME."'".$username."'");
        return self::fetch($response);
    }
    /** Function for create a new user */
    public static function addUser($username, $firstname, $lastname, $email, $password){
        $query = INSERT_USER.
            '(username, firstname, lastname, email, password, function) VALUES '.
            '("'.$username.'", "'.$firstname.'", "'.$lastname.'", "'.$email.'", "'.$password.'", "User")';
        Database::doQuery($query);
    }

    public static function addAdmin($username, $firstname, $lastname, $email, $password, $function){
        $query = INSERT_USER.
            '(username, firstname, lastname, email, password, function) VALUES'.
            '("'.$username.'", "'.$firstname.'", "'.$lastname.'", "'.$email.'", "'.$password.'", "'.$function.'")';
        Database::doQuery($query);
    }

    /** Function for admin to update users data */
    public static function updateUser($request){
        $password = $request->getValue('password');
        $password = md5($password);
        $query = UPDATE_USER.'firstname = "'.$request->getValue('firstname').'", '
                .'lastname = "'.$request->getValue('lastname').'", '
                .'email = "'.$request->getValue('email').'", '
                .'function = "'.$request->getValue('u_function').'", '
                .'password = "'.$password.'" '
            .'WHERE id = '.$request->getValue('id');
        Database::doQuery($query);
    }
    /**
     * Functions: Get
     */
    public function getId() {
        return $this->id;
    }
    public function getPassword(){
    return $this->password;
    }
    public function getFirstName(){
    return $this->firstname;
    }

    public function getLastName(){
    return $this->lastname;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getFunction(){
        return $this->function;
    }

}
