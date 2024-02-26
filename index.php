<?php
require_once 'Board.php';
require_once 'GameEngine.php';
const ROWS = 10;
const COLS = 10;

$board = new Board(ROWS, COLS);
$game = new GameEngine($board);

// можно указать в ручную
//$board->setCell(1, 2, 1);
//$board->setCell(2, 2, 1);
//$board->setCell(3, 2, 1);

// или воспользоваться автогенерацией
$game->randomGenerate($board, ROWS, COLS, 15);

echo "Initial state:\n";
$board->displayBoard();

while (true){
    echo "\nNext generation:\n";
    $game->getNextGeneration();
    $board->displayBoard();
    sleep(5);
}
