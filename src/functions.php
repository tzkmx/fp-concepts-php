<?php

namespace Tzkmx\FP;

function identity($value)
{
    return $value;
}

function compose(callable $f, callable $g): callable
{
    return function() use ($f, $g) {
        $fun_args = func_get_args();

        return $f(call_user_func_array($g, $fun_args));
    };
}

function compose_all(...$functions): callable
{
    return function() use($functions) {
        $fun_args = func_get_args();

        $toApply = array_reverse($functions);

        $rightMostFunction = array_shift($toApply);

        return array_reduce(
            $toApply,
            function($prev, $current_fun) {
                return call_user_func($current_fun, $prev);
            },
            call_user_func_array($rightMostFunction, $fun_args)
        );
    };
}
