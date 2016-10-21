<?php

namespace Dart\Exception;

use Dart\Player;

class GameOverException extends \Exception
{
    /** @var Player */
    private $winner;

    /**
     * @return Player
     */
    public function getWinner(): Player
    {
        return $this->winner;
    }

    /**
     * @param Player $winner
     */
    public function setWinner(Player $winner)
    {
        $this->winner = $winner;
    }
}
