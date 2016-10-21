<?php

require_once(__DIR__.'/vendor/autoload.php');

$game = new \Dart\Game();

$game->addPlayer(new \Dart\Player("John Snow"));
$game->addPlayer(new \Dart\Player("Tyrion Lannister"));
//$game->addPlayer(new \Dart\Player("Daenerys Targaryen"));

$game->play();

$game->printResults(new \Dart\Utils\ConsoleScoreboardPrinter());
