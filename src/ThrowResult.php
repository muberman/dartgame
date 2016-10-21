<?php

namespace Dart;

class ThrowResult
{
    /** @var int */
    private $zone;

    /** @var int */
    private $multiplier;

    public function __construct()
    {
        $this->generateRandomResult();
    }

    private function generateRandomResult()
    {
        // assume missed throws can also happen
        $availableValues = range(0, 20);
        $availableValues[] = 25;

        $this->zone = $availableValues[random_int(0, count($availableValues))];

        // for bullseye max multiplier is 2
        $maxMultiplier = (25 === $this->zone) ? 2 : 3;

        $this->multiplier = random_int(1, $maxMultiplier);
    }

    /**
     * @return int
     */
    public function getResult(): int
    {
        return $this->zone * $this->multiplier;
    }

    /**
     * @return bool
     */
    public function isDouble(): bool
    {
        return 2 === $this->multiplier;
    }

    /**
     * @return bool
     */
    public function isBullseye()
    {
        return 25 === $this->zone;
    }
}
