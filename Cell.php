<?php

class Cell
{
    private bool $isAlive;

    public function __construct(bool $isAlive)
    {
        $this->isAlive = $isAlive;
    }

    public function isAlive(): bool
    {
        return $this->isAlive;
    }

    public function setAlive(bool $isAlive): void
    {
        $this->isAlive = $isAlive;
    }
}
