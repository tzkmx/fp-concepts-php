<?php

use PHPUnit\Framework\TestCase;

class ComposeTest extends TestCase
{
    public function testComposeBasic()
    {
        $expectedF1r = '\"test\"';
        $actualF1r = addslashes('"test"');
        $this->assertEquals($expectedF1r, $actualF1r);

        $expectedF2r = 'TEST';
        $actualF2r = strtoupper('test');
        $this->assertEquals($expectedF2r, $actualF2r);

        $expected = '\"TEST\"';
        $composedFun = \Tzkmx\FP\compose('strtoupper', 'addslashes');
        $actual = $composedFun('"test"');
        $this->assertEquals($expected, $actual);
    }

    public function testComposeAll()
    {
        $input = [
            '.',
            '..',
            '...',
            '....'
        ];
        $expected = 'Ze Ome Yei Nahui';

        $composed_fun = \Tzkmx\FP\compose_all('joinSp', 'translate', 'countDots');

        $this->assertEquals($expected, $composed_fun($input));
    }
}

function toWord(int $num): string {
    $dict = [
        1 => 'Ze',
        2 => 'Ome',
        3 => 'Yei',
        4 => 'Nahui',
    ];
    return $dict[$num] ?? (string)$num;
}
function translate(array $arr) {
    return array_map('toWord', $arr);
}

function joinSp(array $arr): string {
    return implode(' ', $arr);
}

function countDots(array $arr): array {
    return array_map(function (string $dotted) {
        return count(explode('.', $dotted)) - 1;
    }, $arr);
}
