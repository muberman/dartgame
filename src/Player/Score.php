<?php

namespace Dart\Player;

use Dart\Exception\GameOverException;
use Dart\Exception\OverscoreException;
use Dart\Exception\UnfinishableException;
use Dart\ThrowResult;

class Score
{
    /** @var int */
    private $current = 501;

    /** @var int */
    private $turnStart;

    public function saveTurnStart()
    {
        $this->turnStart = $this->current;
    }

    public function resetTurn()
    {
        $this->current = $this->turnStart;
    }

    public function subtract(ThrowResult $throw)
    {
        switch ($throw->getResult() <=> $this->current) {
            case -1:
                $this->current -= $throw->getResult();

                if (false === $this->isFinishable()) {
                    throw new UnfinishableException();
                }

                return;
            case 0:
                if (false === $throw->isDouble() && false === $throw->isBullseye()) {
                    throw new OverscoreException();
                }

                throw new GameOverException();
            case 1:
                throw new OverscoreException();
        }
    }

    /**
     * @return int
     */
    public function getCurrent(): int
    {
        return $this->current;
    }

    /**
     * The last throw must be a double, or bullseye, so the only score that can't be accepted is 1
     *
     * @return bool
     */
    private function isFinishable()
    {
        return $this->current > 1;
    }
}
