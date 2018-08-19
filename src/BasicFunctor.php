<?php

namespace Tzkmx\FP;

class BasicFunctor implements Functor
{
    private $value;
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function map(callable $fun): Functor
    {
        $applied =  call_user_func($fun, $this->value);
        return $applied instanceof Functor
            ? $applied
            : new self($applied);
    }

    public function value()
    {
        return $this->value;
    }
}
