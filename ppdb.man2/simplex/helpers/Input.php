<?php
namespace Helpers;

/**
* Input class
*/
class Input
{
    public static function Post($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
