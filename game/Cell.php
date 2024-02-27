<?php

namespace Game;
class Cell
{
    private bool $isAlive;

    public function __construct(bool $isAlive)
    {
        $this->isAlive = $isAlive;
    }

    public function getIsAlive(): bool
    {
        return $this->isAlive;
    }

    public function setIsAlive(bool $isAlive): void
    {
        $this->isAlive = $isAlive;
    }
}
