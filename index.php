<?php

require_once './vendor/autoload.php';
require_once 'settings.php';

use Game\Board;
use Game\BoardHistory;
use Game\GameEngine;
use Game\Rules;

$board = new Board(BOARD_ROWS, BOARD_COLS);
$rules = new Rules($board);
$game = new GameEngine($board, $rules);
$boardHistory = new BoardHistory();
$boardHistory->setPrevBoardState([]);

// можно указать в ручную
// можно протестировать как реагирует программа на бесконечно повторяющиеся клетки
//$board->setCell(0, 0, 1);
//$board->setCell(0, 1, 1);
//$board->setCell(1, 0, 1);
//$board->setCell(1, 1, 1);

// или воспользоваться автогенерацией
$game->randomGenerate(BOARD_ROWS, BOARD_COLS, CELL_COUNT);

echo "Initial state:\n";
$board->displayBoard();

while ($board->hasLivingCell()){

    echo "\nNext generation:\n";
    $newGen = $game->getNextGeneration();
    $board->displayBoard();

    $currentBoard = $newGen->getBoard();
    $prevBoard = $boardHistory->getPrevBoardState();

    if ($currentBoard == $prevBoard) {
        echo "Текущее состояние доски и предыдущее состояние доски идентичны\n";
        break;
    }

    $boardHistory->setPrevBoardState($newGen->getBoard());
}

echo "\nIteration count: " . $board->getIterationCount() . "\n";
echo "\nGAME OVER\n";
