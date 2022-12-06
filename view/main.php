<!DOCTYPE html>
<html lang="de">

<head>
    <!-- META -->
    <meta charset="utf-8" />
    <meta name="description" content="Mac und Bobby Webshop">
    <!-- CSS stylesheet -->
    <link rel="stylesheet" type="text/css" href="/webshop/view/css/style.css">
    <!-- Java Script -->
    <script src="view/js/jquery-3.4.1.min.js"></script>
    <!-- Font from Google -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">
    <title><?php echo 'Shop:: '.$this->controller->getTitle() ?></title>
</head>

<body>
<div class="logo">
</div>
<div id="page-container">
    <div id="content-wrap">
        <header>
            <div class="header_lang">
                <nav>
                    <ul>
                        <li><a href="index.php?action=<?php echo $template; ?>&lang=en">EN</a></li>
                        <li><a href="index.php?action=<?php echo $template; ?>&lang=de">DE</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header_navi">
                <nav>
                    <ul>
                        <li> <a href="index.php?action=homepage">Home</a> </li>
                        <li> <a href="index.php?action=products"><?php echo $this->translator->getText('Products'); ?></a> </li>
                        <?php if ($this->controller->isAdmin()) echo "<li> <a href=\"index.php?action=admin_product\">".$this->translator->getText('Admin')."</a></li>"; ?>
                        <?php if (!$this->controller->isLoggedIn()) echo "<li><a href=\"index.php?action=login\">".$this->translator->getText('Login')."</a></li>"; ?>
                        <?php if($this->controller->isLoggedIn()) echo "<li><a href=\"index.php?action=account\">".$this->translator->getText('Account')."</a></li>";?>
                        <?php if ($this->controller->isLoggedIn()) echo "<li><a href=\"index.php?action=logout\">".$this->translator->getText('Logout')."</a></li>"; ?>
                        <li> <a href="index.php?action=cart"><?php echo $this->translator->getText('Shopping Cart'); ?></a> </li>
                    </ul>
                </nav>
            </div>

        </header>
        <main>
            <p class="main_text"><?php echo $this->controller->getTitle(); ?></p>
            <?php include $view; ?>
        </main>
    </div>
    <footer class="footer">
        <p> Bobby Lien & Mac Müller </p>
        <a href="https://gitlab.ti.bfh.ch/mullk8/web-programming-bti7054-mac-m-ller-and-bobby-lien">Project @ GitLab BFH</a>
    </footer>
</div>
</body>
</html>