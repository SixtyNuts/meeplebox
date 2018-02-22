<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GamesRepository")
 */
class Games
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $pict;

    /**
     * @ORM\ManyToOne(targetEntity="GameTypes")
     */
    private $gameType;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPict()
    {
        return $this->pict;
    }

    /**
     * @param mixed $pict
     *
     * @return self
     */
    public function setPict($pict)
    {
        $this->pict = $pict;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGameType()
    {
        return $this->gameType;
    }

    /**
     * @param mixed $gameType
     *
     * @return self
     */
    public function setGameType($gameType)
    {
        $this->gameType = $gameType;

        return $this;
    }

}
