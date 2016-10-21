<?php

namespace Dart\Utils;

use Dart\Scoreboard;

interface ScoreboardPrinterInterface
{
    public function print(Scoreboard $scoreboard);
}
