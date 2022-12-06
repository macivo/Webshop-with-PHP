<div>

    <?php
    if(isset($alert)){
        echo '<h3>'.$this->translator->getText($alert).'</h3>';
    }
    ?>
    <h1></h1>
    <form action="index.php?action=login" method="post">
        <p><?php echo $this->translator->getText("Username"); ?>:</p>
    <input type="username" size="40" maxlength="250" name="username"/><br><br>
        <p><?php echo $this->translator->getText("Password"); ?>:</p>
    <input type="password" size="40"  maxlength="250" name="password"/><br>

    <input type="submit" name="submit" value="Login">
    </form>
    <br>
    <a href="index.php?action=register"><button><?php echo $this->translator->getText("Create a new account"); ?></button></a>

</div>