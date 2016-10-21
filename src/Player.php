<?php

namespace Dart;

use Dart\Player\Score;

class Player
{
    /** @var int */
    private static $nextId = 0;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Score */
    private $score;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->id = static::$nextId++;

        $this->score = new Score();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Score
     */
    public function getScore(): Score
    {
        return $this->score;
    }
}
