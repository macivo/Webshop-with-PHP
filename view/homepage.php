<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<p class="homepage_welcome"><?php echo $this->translator->getText('Welcome').' ';
    if (isset($_SESSION['user']["firstname"])){
    echo $_SESSION['user']["firstname"].' ';
    } ?> </p>
<div class="homepage_offer">
</div>
<p class="offer_text"><?php echo $this->translator->getText('Preorder with us possible 10% Discount !!!'); ?></p>
<hr>
<?php
$this->controller->products();
foreach ($this->controller->getData() as $key=>$value){
    $$key = $value;
}
include "view/products.php"; ?>