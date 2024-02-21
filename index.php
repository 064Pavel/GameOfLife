<?php

require_once 'GameOfLife.php';

$game = new GameOfLife(8, 20);
print "GAME START: \n";
print "Generate... \n";
$gameSpace = $game->generateLife();
$game->printLife($gameSpace);

while (true) {
    print "New Generation: \n";
    $gameSpace = $game->runLife($gameSpace);
    $game->printLife($gameSpace);

    sleep(5);
}
