<?php

namespace dmitrybukhonov\adyammy\widgets\factory;

interface AdBlockInterface
{
    public function getView(): string;
    public function getPositionId(): int;
}
