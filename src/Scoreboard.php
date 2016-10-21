<?php

namespace Dart;

class Scoreboard
{
    /** @var array */
    private $results = [];

    /** @var Player[] */
    private $players = [];

    /** @var Player */
    private $winner;

    public function addTurnResult(int $turnIndex, Player $player, int $score)
    {
        if (false === isset($this->players[$player->getId()])) {
            $this->players[$player->getId()] = $player;
        }

        if (false === isset($this->results[$turnIndex])) {
            $this->results[$turnIndex] = [];
        }

        $this->results[$turnIndex][$player->getId()] = $score;
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @return Player[]
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @return int
     */
    public function getLastTurnIndex(): int
    {
        return array_pop(array_keys($this->results));
    }

    /**
     * @param Player $winner
     */
    public function setWinner(Player $winner)
    {
        $this->winner = $winner;
    }

    /**
     * @return Player
     */
    public function getWinner()
    {
        return $this->winner;
    }
}
