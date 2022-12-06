<?php
/** Welcome to macbobby-shop
 * Mac Müller & Bobby Lien
 */
    require_once 'autoloader.php';
    session_start();
    if (!isset($_SESSION['lang'])) {
        $_SESSION['lang'] = 'de';
    }

    $request = new Request();
    $action = $request -> getValue('action', 'homepage');

    if (!Database::connection()){
        die('No connection to database: '.Database::getInstance()->connection_error);
    }

    try {
        $controller = new Controller();
        $template = $controller -> $action($request);
        $template = $template ? $template : $action;

        $view = new View($controller);
        if($request->isParameter('lang')){
            $view->translator->setLanguage($request->getValue('lang'));
        }
        $view->render($template);

    } catch (Exception $exception) {
        die('<h1> Exception: '.$exception->getMessage());
    }