<?php

namespace Game;
use Game\Contracts\BoardInterface;

class GameEngine
{
    private BoardInterface $board;
    private Rules $rules;
    public function __construct(BoardInterface $board, Rules $rules)
    {
        $this->board = $board;
        $this->rules = $rules;
    }

    public function getNextGeneration(): BoardInterface
    {
        $nextGen = $this->board->createNewBoard();

        $this->rules->execute($nextGen);

        $this->updateBoard($nextGen);

        return $nextGen;
    }

    private function updateBoard(BoardInterface $nextGen): void
    {
        $this->board->processCell(function ($i, $j) use ($nextGen) {
            $this->board->setCell($i, $j, $nextGen->getCell($i, $j)->getIsAlive() ? CELL_ALIVE : CELL_DEAD);
        });

    }

    public function randomGenerate(int $rows = 5, int $cols = 5, int $count = 7): void
    {
        for ($i = 0; $i < $count; $i++) {
            $randRows = rand(1, $rows) - 1;
            $randCols = rand(1, $cols) - 1;
            $this->board->setCell($randRows, $randCols, CELL_ALIVE);
        }
    }
}