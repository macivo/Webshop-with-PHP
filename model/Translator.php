<?php
/**
 * Class Translator
 * Translator will declare in the View.php
 * Every text translation has to call: $this->translator->getText('$text')
 */

class Translator {
    private $data = array();
    /** read from a file
     * a sign '=' ist between the english and german text
     */
    public function __construct() {
        $file = file('view/languages/en_de.txt');
        foreach ($file as $line) {
            list($key, $value) = explode('=', $line);
            $this->data[$key] = $value;
        }
    }
    /** if the text not-found, do not throw an exception, but just give the same text */
    public function getText($text) {
        if (isset($_SESSION['lang'])
            && $_SESSION['lang'] == 'de'
            && isset($this->data[$text])) {
            return $this->data[$text];
        } else {
            return "$text";
        }
    }
    /** Function: to switch the language */
    public function setLanguage($language) {
        $_SESSION['lang'] = $language;
    }


}