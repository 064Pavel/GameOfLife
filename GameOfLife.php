<?php

class GameOfLife
{
    public function __construct(
        private int $spaceX,
        private int $spaceY,
    )
    {
    }

    public function generateLife(): array
    {
        $x = $this->spaceX;
        $y = $this->spaceY;
        $space = [];

        for ($i = 0; $i < $x; $i++) {
            for ($j = 0; $j < $y; $j++) {

                $rand = rand(0, 6);

                if ($rand === 0) {
                    $space[$i][$j] = "@"; // живая клетка
                } else {
                    $space[$i][$j] = "`"; // мертвая/пустая клетка
                }
            }
        }

        return $space;
    }

    public function getNeighboringCellsCount(array $space, int $x, int $y): int
    {
        $count = 0;

        for ($k = -1; $k <= 1; $k++) {
            for ($l = -1; $l <= 1; $l++) {

                if ($k == 0 && $l == 0) {
                    continue;
                }

                if ($x + $k >= 0 && $x + $k < count($space) && $y + $l >= 0 && $y + $l < count($space[$x + $k])) {

                    if ($space[$x + $k][$y + $l] == "@") {
                        $count++;
                    }
                }
            }
        }

        return $count;
    }

    public function runLife(array $space): array
    {
        for ($i = 0; $i < count($space); $i++) {
            for ($j = 0; $j < count($space[$i]); $j++) {
                $neighborCount = $this->getNeighboringCellsCount($space, $i, $j);

                if ($neighborCount < 2 || $neighborCount > 3) {
                    $space[$i][$j] = "`"; // Клетка умирает от одиночества или переполнения
                } elseif ($neighborCount === 2 || $neighborCount === 3) {
                    // Клетка остается живой
                } elseif ($neighborCount === 3 && $space[$i][$j] === "`") {
                    $space[$i][$j] = "@"; // Мертвая клетка рождается
                }
            }
        }

        return $space;
    }

    public function printLife(array $space): void
    {
        foreach ($space as $row) {
            foreach ($row as $column) {
                echo $column . " ";
            }
            echo "\n";
        }
    }
}