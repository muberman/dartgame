<?php

namespace Dart\Utils;

use Dart\Player;
use Dart\Scoreboard;

class ConsoleScoreboardPrinter implements ScoreboardPrinterInterface
{
    /** @var Scoreboard */
    private $scoreboard;

    /** @var array */
    private $paddingByPlayerId = [];

    /** @var int */
    private $turnNumberPadding;

    const COLUMN_SEPARATOR = ' | ';

    const PLAYER_TITLE = "Player:";

    const TURN_TITLE = "Turn ";

    public function print(Scoreboard $scoreboard)
    {
        $this->scoreboard = $scoreboard;
        $this->turnNumberPadding = max(strlen(self::PLAYER_TITLE), strlen(self::TURN_TITLE . $this->scoreboard->getLastTurnIndex()));

        $this->calculatePlayerPaddings();
        $this->printPlayersHeader();
        $this->printTurns();
        $this->printWinner();
    }

    private function calculatePlayerPaddings()
    {
        array_walk($this->scoreboard->getPlayers(), function(Player $player) {
            $this->paddingByPlayerId[$player->getId()] = mb_strlen($player->getName());
        });
    }

    private function printPlayersHeader()
    {
        echo "Player:" . self::COLUMN_SEPARATOR . join(array_map(
            function(Player $player) {
                return $player->getName();
            },
            $this->scoreboard->getPlayers()
        ), self::COLUMN_SEPARATOR) . PHP_EOL;
    }

    private function printTurns()
    {
        $startingTurn = [str_pad("Start", $this->turnNumberPadding, " ", STR_PAD_RIGHT)];

        foreach ($this->scoreboard->getPlayers() as $player) {
            $startingTurn[] = $this->padPlayerResult(501, $player->getId());
        }

        echo join(self::COLUMN_SEPARATOR, $startingTurn) . PHP_EOL;

        foreach ($this->scoreboard->getResults() as $turnIndex => $turnResults) {
            $turn = [$this->padTurn($turnIndex)];

            foreach($turnResults as $playerIndex => $result) {
                $turn[] = $this->padPlayerResult($result, $playerIndex);
            }

            echo join(self::COLUMN_SEPARATOR, $turn) . PHP_EOL;
        }
    }

    /**
     * @param int $turnIndex
     * @return string
     */
    private function padTurn(int $turnIndex)
    {
        return self::TURN_TITLE . str_pad($turnIndex, $this->turnNumberPadding - strlen(self::TURN_TITLE), " ", STR_PAD_LEFT);
    }

    /**
     * @param int $result
     * @param int $playerId
     * @return string
     */
    private function padPlayerResult(int $result, int $playerId)
    {
        return str_pad($result, $this->paddingByPlayerId[$playerId], " ", STR_PAD_LEFT);
    }

    private function printWinner()
    {
        $winner = $this->scoreboard->getWinner();

        if (null === $winner) {
            echo "Game ended without a winner" . PHP_EOL;

            return;
        }

        echo "Winner: " . $winner->getName() . PHP_EOL;
    }
}
