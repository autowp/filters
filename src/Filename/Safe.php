<?php

namespace Autowp\Filter\Filename;

use Zend\Filter\FilterInterface;
use Autowp\Filter\Transliteration;

class Safe implements FilterInterface
{
    private $_replace = array (
        "№" => "N",
        " " => '_',
        '"' => '_',
        "/" => '_',
        '*' => '_',
        '`' => '_',
        '#' => '_',
        '&' => '_',
        '\\' => '_',
        '!' => '_',
        '@' => '_',
        '$' => 's',
        '%' => '_',
        '^' => '_',
        '=' => '-',
        '|' => '_',
        '?' => '_',
        '„' => ',',
        '“' => '_',
        '”' => '_',
        '{' => '(',
        '}' => ')',
        ':' => '-',
        ';' => '_',
        '-' => '-',
    );


    /**
     * Defined by FilterInterface
     *
     * @param  string $value
     * @return string
     */
    public function filter($value)
    {
        $transliteration = new Transliteration();

        $value = $transliteration->filter($value);
        $value = mb_strtolower($value);

        $value = strtr($value, $this->_replace);

        $value = trim($value, '_-');

        $value = preg_replace('|[^A-Za-z0-9.(){}_-]|isu', '_', $value);

        do {
            $oldLength = strlen($value);
            $value = str_replace('__', '_', $value);
        } while ($oldLength != strlen($value));

        if (strlen($value) == 0) {
            $value = '_';
        }

        switch ($value) {
            case '..': $value = '__'; break;
            case '.':  $value = '_'; break;
        }

        return $value;
    }

}
