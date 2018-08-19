<?php

use \PHPUnit\Framework\TestCase;
use Tzkmx\FP\BasicFunctor;

class TestFunTest extends TestCase
{
    public function testBasicMap()
    {
        $functor = new BasicFunctor(20);
        $aNew = $functor->map(function($val) {
            return $val;
        });

        $this->assertEquals($aNew, $functor);
    }

    public function testIdentity()
    {
        $functor = new BasicFunctor(20);

        $appliedToFunctor = Tzkmx\FP\identity($functor);

        $appliedByFmap = $functor->map('Tzkmx\FP\identity');

        $this->assertEquals($appliedToFunctor, $appliedByFmap);
    }

    public function testCompose()
    {
        $functor = new BasicFunctor(-20);

        $expected = new BasicFunctor(260);

        $by13 = function ($num) { return $num * 13; };

        $composedFun = \Tzkmx\FP\compose_all('abs', $by13);

        $appliedComposed = $functor->map($composedFun);

        $appliedSuccess = $functor->map($by13)->map('abs');

        $this->assertEquals($expected, $appliedComposed);
        $this->assertEquals($expected, $appliedSuccess);
    }
}
