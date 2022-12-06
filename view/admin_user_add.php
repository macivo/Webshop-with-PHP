<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div>

    <h3>

    </h3>

    <?php
    $showFormular = true;

    if($showFormular) {
        ?>

        <form action="index.php?action=admin_user_add" method="post">

            Firstname:<br>
            <input type="text" size="40" maxlength="250" name="firstname" id="firstname"><br><br>

            Lastname:<br>
            <input type="text" size="40" maxlength="250" name="lastname" id="lastname""><br><br>

            Username:<br>
            <input size="40" maxlength="250" name="username"><br><br>

            Password:<br>
            <input type="password" size="40"  maxlength="250" name="password"><br><br>

            Email:<br>
            <input type="email" size="40"  maxlength="250" name="email"><br><br>

            Function:<br>
            <input type="text" size="40"  maxlength="250" name="function"><br>

            <input type="submit" name="add" value="Add">
        </form>

        <?php
    }
    ?>

</div>