<?php

require_once 'Board.php';

class GameEngine
{
    private Board $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function getNextGeneration(): void
    {
        $nextGen = new Board($this->board->getRows(), $this->board->getCols());

        for ($i = 0; $i < $this->board->getRows(); $i++) {
            for ($j = 0; $j < $this->board->getCols(); $j++) {
                $neighbors = $this->countNeighbors($i, $j);

                if ($this->board->getCell($i, $j)->isAlive()) {
                    if ($neighbors < 2 || $neighbors > 3) {
                        $nextGen->setCell($i, $j, 0); // клетка умирает из-за перенаселения или одиночества
                    } else {
                        $nextGen->setCell($i, $j, 1); // клетка продолжает жить
                    }
                } else {
                    if ($neighbors === 3) {
                        $nextGen->setCell($i, $j, 1); // мертвая клетка оживает
                    }
                }
            }
        }

        for ($i = 0; $i < $this->board->getRows(); $i++) {
            for ($j = 0; $j < $this->board->getCols(); $j++) {
                $this->board->setCell($i, $j, $nextGen->getCell($i, $j)->isAlive() ? 1 : 0);
            }
        }

    }



    public function countNeighbors(int $row, int $col): int
    {
        $count = 0;

        for ($i = $row - 1; $i <= $row + 1; $i++) {
            for ($j = $col - 1; $j <= $col + 1; $j++) {
                if ($i >= 0 && $i < $this->board->getRows() && $j >= 0 && $j < $this->board->getCols() && !($i == $row && $j == $col)) {
                    $count += $this->board->getCell($i, $j)->isAlive() ? 1 : 0;
                }
            }
        }

        return $count;
    }

    public function randomGenerate(Board $board, int $rows = 5, int $cols = 5, int $count = 7): void
    {
        for ($i = 0; $i < $count; $i++){
            $randRows = rand(1, $rows) - 1;
            $randCols = rand(1, $cols) - 1;
            $board->setCell($randRows, $randCols, 1);
        }
    }
}