<div>

<?php
        if(isset($alert)){
            echo '<h3>'.$this->translator->getText($alert).'</h3>';
        }
    $showFormular = true;

    if($showFormular) {
    ?>

    <form action="index.php?action=register" method="post">

        <p><?php echo $this->translator->getText("Firstname"); ?>:</p>
        <input type="text" size="40" maxlength="250" name="firstname" id="firstname"><br><br>

        <p><?php echo $this->translator->getText("Lastname"); ?>:</p>
        <input type="text" size="40" maxlength="250" name="lastname" id="lastname""><br><br>

        <p><?php echo $this->translator->getText("Username"); ?>:</p>
        <input size="40" maxlength="250" name="username"><br><br>

        <p><?php echo $this->translator->getText("Password"); ?>:</p>
        <input type="password" size="40"  maxlength="250" name="password"><br><br>

        <p><?php echo $this->translator->getText("Email"); ?>:</p>
        <input type="email" size="40"  maxlength="250" name="email"><br>

    <input type="submit" name="register" value="<?php echo $this->translator->getText("Register"); ?>">
    </form>

<?php
}
?>

</div>