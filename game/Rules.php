<?php

namespace Game;

use Game\Contracts\BoardInterface;

class Rules
{
    private BoardInterface $board;

    public function __construct(BoardInterface $board)
    {
        $this->board = $board;
    }
    public function execute(BoardInterface $nextGen): void
    {
        $this->board->processCell(function ($i, $j) use ($nextGen) {
            $neighbors = $this->countNeighbors($i, $j);
            $currentCell = $this->board->getCell($i, $j);

            if ($currentCell->getIsAlive()) {
                $this->applyRulesForAliveCell($nextGen, $i, $j, $neighbors);
            } else {
                $this->applyRulesForDeadCell($nextGen, $i, $j, $neighbors);
            }
        });
    }

    private function applyRulesForAliveCell(BoardInterface $nextGen, int $i, int $j, int $neighbors): void
    {
        if ($neighbors < 2 || $neighbors > 3) {
            $nextGen->setCell($i, $j, CELL_DEAD);
        } else {
            $nextGen->setCell($i, $j, CELL_ALIVE);
        }
    }

    private function applyRulesForDeadCell(BoardInterface $nextGen, int $i, int $j, int $neighbors): void
    {
        if ($neighbors === 3) {
            $nextGen->setCell($i, $j, CELL_ALIVE);
        }
    }

    private function countNeighbors(int $row, int $col): int
    {
        $count = 0;
        $rows = $this->board->getRows();
        $cols = $this->board->getCols();

        for ($i = $row - 1; $i <= $row + 1; $i++) {
            for ($j = $col - 1; $j <= $col + 1; $j++) {
                if ($this->isValidCell($i, $j, $rows, $cols, $row, $col)) {
                    $count += $this->getCellStatus($i, $j);
                }
            }
        }

        return $count;
    }

    private function isValidCell(int $i, int $j, int $rows, int $cols, int $row, int $col): bool
    {
        return $i >= 0 && $i < $rows && $j >= 0 && $j < $cols && !($i === $row && $j === $col);
    }

    private function getCellStatus(int $i, int $j): int
    {
        return $this->board->getCell($i, $j)->getIsAlive() ? CELL_ALIVE : CELL_DEAD;
    }
}