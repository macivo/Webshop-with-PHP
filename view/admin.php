<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="header_navi">
    <nav>
        <ul>
            <li> <a href="index.php?action=admin_product"><?php echo $this->translator->getText('Products'); ?></a> </li>
            <li> <a href="index.php?action=admin_user"><?php echo $this->translator->getText('Users'); ?></a> </li>
            <li> <a href="index.php?action=admin_order"><?php echo $this->translator->getText('Ordes'); ?></a> </li>
        </ul>
    </nav>
</div>
