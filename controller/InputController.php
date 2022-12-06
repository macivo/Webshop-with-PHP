<?php
/**
 * Validate the input
 */

class InputController
{

    public static function checkString($string)
    {
        $string = htmlspecialchars($string);
        $string = filter_var($string, FILTER_SANITIZE_STRING);

        if (empty($string))
        {
            throw new Exception("String is empty");
        }
        else if ($string === false)
        {
            throw new Exception("It was not a string");
        }
        return $string;
    }
    /**
     * Check Integer
     */
    public function validateIntGet($int)
    {
        $int = htmlspecialchars($int);
        $int = filter_var($int, FILTER_VALIDATE_INT);

        if (empty($int))
        {
            throw new Exception("Empty value");
        }
        else if ($int === false)
        {
            throw new Exception("Not an integer value");
        }
        return $int;
    }


    public static function checkName($name)
    {
        $name = self::checkString($name);
        $nameMinLength = 3;
        $nameMaxLength = 50;

        if (strlen($name) < $nameMinLength)
        {
            throw new Exception("Name is too short");
        }
        if (strlen($name) > $nameMaxLength)
        {
            throw new Exception("Name is too long");
        }
        if (!preg_match("@^[a-zA-Z]+$@", $name))
        {
            throw new Exception("Name should not contain a Number");
        }
        return $name;
    }

    public static function checkPassword($password)
    {

        $pswMinLength = 3;
        $pswMaxLength = 50;

        if (strlen($password) < $pswMinLength)
        {
            throw new Exception("too short password");
        }
        if (strlen($password) > $pswMaxLength)
        {
            throw new Exception("too long password");
        }

        $uppercase = preg_match('@(?=.*[A-Z])@', $password);
        $lowercase = preg_match('@(?=.*[a-z])@', $password);
        $number    = preg_match('@(?=.*\d)@', $password);

        if (!$uppercase || !$lowercase || !$number)
        {
            throw new Exception("password not accepted");
        }

        return $password;
    }

}