<?php

namespace AutowpTest\Filter;

use Autowp\Filter\Transliteration;

/**
 * @group Autowp_Filter
 */
class TransliterationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctProvider
     */
    public function testCorrect($text, $expected)
    {
        $filter = new Transliteration();
        $result = $filter->filter($text);
        $this->assertEquals($expected, $result);
    }
 
    public static function correctProvider()
    {
        return [
            ['абвгдеёжзиклмнопрстуфх ц ч ш щ ъыь эюя', 'abvgdeezhziklmnoprstufkh ts ch sh shch y eyuya']
        ];
    }
}