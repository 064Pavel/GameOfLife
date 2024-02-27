<?php

namespace Game;
use Game\Contracts\BoardInterface;

class Board implements BoardInterface
{
    private array $board;
    private int $rows;
    private int $cols;
    private int $iterationCount = 0;

    public function __construct(int $rows, int $cols)
    {
        $this->rows = $rows;
        $this->cols = $cols;

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                $this->board[$i][$j] = new Cell(CELL_DEAD);
            }
        }
    }

    public function hasLivingCell(): bool
    {
        $hasLivingCell = false;

        foreach ($this->board as $row) {
            foreach ($row as $cell) {
                if ($cell->getIsAlive()) {
                    $hasLivingCell = true;
                    break 2;
                }
            }
        }

        return $hasLivingCell;
    }

    public function getBoard(): array
    {
        return $this->board;
    }

    public function setCell(int $row, int $col, int $value): void
    {
        $this->board[$row][$col]->setIsAlive($value);
    }

    public function getCell(int $row, int $col): Cell
    {
        return $this->board[$row][$col];
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function setRows(int $rows): void
    {
        $this->rows = $rows;
    }

    public function getCols(): int
    {
        return $this->cols;
    }

    public function setCols(int $cols): void
    {
        $this->cols = $cols;
    }

    public function getIterationCount(): int
    {
        return $this->iterationCount;
    }


    public function processCell(callable $fn): void
    {
        $rows = $this->getRows();
        $cols = $this->getCols();

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                $fn($i, $j);
            }
        }
    }

    public function createNewBoard(): BoardInterface
    {
        return new Board($this->getRows(), $this->getCols());
    }

    public function displayBoard(): void
    {
        $this->iterationCount++;

        foreach ($this->board as $row) {
            foreach ($row as $cell) {
                echo $cell->getIsAlive() ? CELL_ALIVE_SYMBOL : CELL_DEAD_SYMBOL;
            }
            echo "\n";
        }
    }
}

