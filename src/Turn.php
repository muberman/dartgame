<?php

namespace Dart;

use Dart\Exception\GameOverException;
use Dart\Exception\OverscoreException;
use Dart\Exception\UnfinishableException;

class Turn
{
    /** @var int */
    private $index;

    /** @var int */
    private $maxThrowsInTurn = 3;

    /**
     * Turn constructor.
     * @param int $index
     */
    public function __construct(int $index)
    {
        $this->index = $index;
    }

    /**
     * @param Player $player
     * @return int
     * @throws GameOverException
     */
    public function execute(Player $player): int
    {
        $playerScore = $player->getScore();
        $playerScore->saveTurnStart();

        for ($i = 1; $i <= $this->maxThrowsInTurn; $i++) {
            try {
                $playerScore->subtract(new ThrowResult());
            } catch (OverscoreException $e) {
                $playerScore->resetTurn();

                break;
            } catch (UnfinishableException $e) {
                $playerScore->resetTurn();

                break;
            } catch (GameOverException $e) {
                $e->setWinner($player);

                throw $e;
            }
        }

        return $playerScore->getCurrent();
    }

    /**
     * @return int
     */
    public function getIndex(): int
    {
        return $this->index;
    }
}
