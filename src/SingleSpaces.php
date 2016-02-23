<?php

namespace Autowp\Filter;

use Zend_Filter_Interface;

class SingleSpaces implements Zend_Filter_Interface
{
    public function filter($value)
    {
        if (strlen($value) <= 0)
            return '';

        $value = str_replace("\r", "", $value);
        $lines = explode("\n", $value);
        foreach ($lines as &$line) {
            $line = preg_replace('/[[:space:]]+/s', ' ', $line);
        }
        return implode("\n", $lines);
    }
}