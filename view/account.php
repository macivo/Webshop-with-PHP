<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div>
     <h2> <?php echo $this->translator->getText("Edit your profile"); ?></h2>
    <br>
    <form action="index.php?action=account" method="post">
        <label><?php echo $this->translator->getText("New Username"); ?></label><br>
        <input type="text" id="fname" name="fname"><br>
        <label><?php echo $this->translator->getText("New E-Mail"); ?></label><br>
        <input type="text" id="fname" name="fname"><br>
        <label><?php echo $this->translator->getText("New Password"); ?></label><br>
        <input type="text" id="fname" name="fname"><br>
        <input type="submit" value="<?php echo $this->translator->getText("Save"); ?>">
    </form>

</div>