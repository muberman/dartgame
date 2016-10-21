<?php

namespace Dart;

use Dart\Exception\GameOverException;
use Dart\Exception\NotEnoughPlayersException;
use Dart\Utils\ScoreboardPrinterInterface;

class Game
{
    /** @var Player[] */
    private $players = [];

    /** @var int */
    private $turnIndex = 1;

    /** @var Scoreboard */
    private $scoreboard;

    /** @var int */
    private $turnsLimit = 500;

    public function __construct()
    {
        $this->scoreboard = new Scoreboard();
    }

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->players[$player->getId()] = $player;
    }

    public function play()
    {
        try {
            $this->validatePlayers();

            // limit the number of turns, just in case something goes wrong
            while ($this->turnIndex <= $this->turnsLimit) {
                $this->nextTurn();
            }
        } catch (NotEnoughPlayersException $e) {
            echo "Error: " . $e->getMessage() . PHP_EOL;
        } catch (GameOverException $e) {
            $this->scoreboard->setWinner($e->getWinner());
        }
    }

    /**
     * @return Scoreboard
     */
    public function getScoreboard()
    {
        return $this->scoreboard;
    }

    private function validatePlayers()
    {
        if (count($this->players) < 2) {
            throw new NotEnoughPlayersException("There must be at least 2 players in the game");
        }
    }

    private function nextTurn()
    {
        $turn = new Turn($this->turnIndex++);

        foreach ($this->players as $player) {
            try {
                $turnResult = $turn->execute($player);

                $this->scoreboard->addTurnResult($turn->getIndex(), $player, $turnResult);
            } catch (GameOverException $e) {
                // add last result to the scoreboard, to display it nicely
                $this->scoreboard->addTurnResult($turn->getIndex(), $player, 0);

                throw $e;
            }
        }
    }
}
