<?php

namespace Game;
class BoardHistory
{
    private array $prevBoardState;

    public function getPrevBoardState(): array
    {
        return $this->prevBoardState;
    }

    public function setPrevBoardState(array $prevBoardState): void
    {
        $this->prevBoardState = $prevBoardState;
    }
}