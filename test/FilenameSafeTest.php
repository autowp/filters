<?php

namespace AutowpTest\Filter;

use Autowp\Filter\Filename\Safe;

/**
 * @group Autowp_Filter
 */
class FilenameSafeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider correctProvider
     */
    public function testCorrect($text, $expected)
    {
        $filter = new Safe();
        $result = $filter->filter($text);
        $this->assertEquals($expected, $result);
    }

    public static function correctProvider()
    {
        return [
            ['just.test', 'just.test'],
            ['.', '_'],
            ['..', '__'],
            ['...', '...'],
            ['', '_'],
            ['just test', 'just_test'],
            ['просто тест ', 'prosto_test'],
            ['数据库', 'shu_ju_ku'],
            ['Škoda', 'skoda']
        ];
    }
}