<?php

namespace Tzkmx\FP;

interface Functor {
    public function map(callable $fun): Functor;
}
