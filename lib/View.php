<?php
/**
 * Class View: Copy from a course Programming BTI7054
 * Generate automatic the page view from the template
 * Also call fetch the data from controller as array for direct using
 */
class View
{
    private $controller;
    public $text = array();
    public $translator;
    /**
     * View constructor.
     * @param Controller $controller
     */
    public function __construct(Controller $controller)    {
        $this->controller = $controller;
        $this->translator = new Translator();
    }

    /** Generate a view form actions call */
    public function render($template) {
        $view = "view/$template.php";
        if(!file_exists($view)) {
            throw new Exception("No template");
        }
        /** fectch the data as array */
        foreach ($this->controller->getData() as $key=>$value){
            $$key = $value;
        }

        $viewTitle = $this->controller->getTitle();
        $title = "MacBobby::" . ($viewTitle ? " - ".$viewTitle : "");

        include "view/main.php";
    }




}