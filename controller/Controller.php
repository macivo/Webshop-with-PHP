<?php
/**
 * Main Controller
 * Every times, when a page via index.php to page call, a function for the page will be called here
 *
 */

class Controller
{
    private $title = '';
    private $data = array();
    private $alert = '';

    /**
     * Controller constructor.
     */
    public function __construct() {
    }

    /** functions for the pages
     * Function: homepage
     */
    public function homepage(Request $request) {
        $this->title = 'Home';
    }
    /** Function: checkout buy products */
    public function checkout(Request $request){
        if(!$this->isLoggedIn()){
            header("Location: index.php?action=login");
        }
        $this->title = "Checkout";
        $this->data['addresses'] = Address::getAdressesById();
        if($request->isParameter('add_address')){
            Address::addAdresses($request);
        }
        if($request->isParameter('_makeOrder')){
            Order::addOrder($request);
        }
    }

    /**
     * Function: Admin: always check the admin-right by every calls
     */
    public function admin(Request $request){
        $this->title = "Administrator";
    }
    public function admin_order(){
        $this->checkAdmin();
        $this->title = "Admin: Orders";
        $this->data['orders'] = Order::getOrder();
    }
    public function admin_user(Request $request){
        $this->checkAdmin();
        $this->title = "Admin: Users";
        if($request->isParameter("_updateUser")){
            User::updateUser($request);
        }
    }

    public function admin_user_add(Request $request){
        $this->checkAdmin();
        $this->title = "Add new User";
        $username = $request->getValue("username");
        $firstname = $request->getValue("firstname");
        $lastname = $request->getValue("lastname");
        $email = $request->getValue("email");
        $password = $request->getValue("password");
        $function = $request->getValue("function");
        User::addUser($username, $firstname, $lastname, $email, $password, $function);
    }
    public function admin_product(){
        $this->checkAdmin();
        $this->title = "Admin: Products";
    }
    public function admin_product_edit(Request $request){
        $this->checkAdmin();
        if($request->isParameter('update_product')){
            Product::updateProduct($request);
        }
        if($request->isParameter('update_option')){
            Option::updateOption($request);
        }
        if($request->isParameter('add_option')){
            Option::addOption($request);
        }
        $this->title = "Admin: Products: Edit";
        $this->data['products'] = Product::getProductById($request->getValue('id'));
    }
    public function admin_product_add(Request $request){
        $this->checkAdmin();
        $this->title = "Admin: Product: Add";
        if($request->isParameter('addProduct')){
            Product::addProduct($request);
        }

    }

    /** Function: Registration for a account */
    public function register(Request $request) {
            $this->title = 'Register';
            $username = $request->getValue("username");
            $firstname = $request->getValue("firstname");
            $lastname = $request->getValue("lastname");
            $email = $request->getValue("email");
            $password = $request->getValue("password");
            try {
                InputController::checkName($username);
                InputController::checkName($lastname);
                InputController::checkName($username);
                InputController::checkPassword($password);
            } catch (Exception $e) {
                $this->data['alert'] = $e->getMessage().' !!!';
                return;
            }
            User::addUser($username, $firstname, $lastname, $email, $password);
    }

    public function account(Request $request){
        $this->title = 'Account';
    }

    /** Function: Shopping-cart */
    public function cart(Request $request) {
        $this->title = 'Shopping Cart';
        if($request->isParameter('remove')){
                        $cartController = new CartController();
            $cartController->removeFromCart($request->getValue('remove'));
        }
    }

    /** Function: To list the products */
    public function products() {
        $this->title = 'Products';
        $this->data['products'] = Product::getProducts();
    }

    /** Function: For Product Pop-up */
    public function show_product(Request $request) {
    }

    /** Function: Login to an account
     * Password was saved with md5 message-digest algorithm
     */
    public function login(Request $request) {
        $this->title = 'Login';
        if ($this->isLoggedIn()) {
            echo "you already logged in";
        }
        if ($request->isParameter('submit')) {
            $username = $request->getValue("username");
            $password = $request->getValue("password");
            try {
                InputController::checkName($username);
            } catch (Exception $e) {
                $this->data['alert'] = $e->getMessage().' !!!';
                return;
            }
            $user = User::getUserByName($username);
            if ($user == null) {
                $this->data['alert'] = 'ERROR:: Wrong login data!';
            } else if ($user[0]->getPassword() == md5($password)) {
                $_SESSION['user']['username'] = $username;
                $_SESSION['user']['firstname'] = $user[0]->getFirstName();
                $_SESSION['user']['function'] = $user[0]->getFunction();
                $_SESSION['user']['id'] = $user[0]->getId();
                $this->data['alert'] = 'you are logged in';
                header("Location: index.php");
            } else {
                $this->data['alert'] = 'ERROR:: Wrong login data!';
            }
        }
    }

    /** Help-functions*/
     public function logout(Request $request)   {
        $this->title = 'logout';

        if ($this -> isLoggedIn()){
            $_SESSION['user'] = array();
         }}

     public function isLoggedIn(){
     return isset($_SESSION['user']['username']);
     }

    public function isUser() {
        if (isset($_SESSION['user']['function'])){
            if ($_SESSION['user']['function'] === 'User'){
                return true;
            }
        }
    }
    public function isAdmin() {
        if (isset($_SESSION['user']['function'])){
            if ($_SESSION['user']['function'] === 'Admin'){
                return true;
            }
        }
    }
    private function checkAdmin(){
        if(!$this->isAdmin()) {
            header("Location: index.php?action=login");
        }
    }
    public function getData() {
        return $this->data;
    }
    public function getAlert(){
        return $this->alert;
    }
    public function getTitle() {
        return $this->title;
    }
    public function en() {
        $this->translator->setLanguage('en');
    }
    public function de() {
        $this->translator->setLanguage('de');
    }
}