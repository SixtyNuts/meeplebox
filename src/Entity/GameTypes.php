<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameTypesRepository")
 */
class GameTypes
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
    private $typeCode;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $typeText;

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
    public function getTypeCode()
    {
        return $this->typeCode;
    }

    /**
     * @param mixed $typeCode
     *
     * @return self
     */
    public function setTypeCode($typeCode)
    {
        $this->typeCode = $typeCode;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeText()
    {
        return $this->typeText;
    }

    /**
     * @param mixed $typeText
     *
     * @return self
     */
    public function setTypeText($typeText)
    {
        $this->typeText = $typeText;

        return $this;
    }
}
