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
    public function testCorrect($text, $pattern)
    {
        $filter = new Transliteration();
        $result = $filter->filter($text);
        $this->assertRegexp($pattern, $result);
    }

    public static function correctProvider()
    {
        return [
            ['абвгдеёжзиклмнопрстуфх ц ч ш щ ъыь эюя', '/^abvgdeezziklmnoprstufh c c s s ("|ʺ)y(ʹ|\') eua$/'],
            ['Škoda', '/^Skoda$/'],
            ['数据库', '/^shu ju ku$/'],
        ];
    }
}