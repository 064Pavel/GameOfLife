<?php

namespace Game\Contracts;

interface BoardInterface
{
    public function displayBoard(): void;
    public function createNewBoard(): BoardInterface;
    public function processCell(callable $fn): void;
    public function getIterationCount(): int;
}