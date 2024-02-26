<?php

require_once 'Cell.php';
class Board
{
    private array $board;
    private int $rows;
    private int $cols;
    public function __construct(int $rows, int $cols)
    {
        $this->rows = $rows;
        $this->cols = $cols;

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                $this->board[$i][$j] = new Cell(0);
            }
        }
    }


    public function setCell(int $row, int $col, int $value): void
    {
        $this->board[$row][$col]->setAlive($value);
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



    public function displayBoard(): void
    {
        foreach ($this->board as $row) {
            foreach ($row as $cell) {
                echo $cell->isAlive() ? 'O' : '-';
            }
            echo "\n";
        }
    }
}

