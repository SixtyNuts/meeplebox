<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="E-mail déjà enregistré"
 * )
  * @UniqueEntity(
 *     fields={"pseudo"},
 *     message="Pseudo déjà utilisé"
 * )

 */
class Users
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $birthday;

  	/**
     * @ORM\Column(type="string", nullable=false, unique=true)
     * @Assert\NotBlank()
     */
    private $email;
    
    /**
     * @ORM\ManyToMany(targetEntity="GameTypes", cascade={"persist"})
     * @ORM\JoinTable(name="games_pref")
     */
    private $gamesPref;


    public function __construct()
    {
        $this->gamesPref = new ArrayCollection();
    }   



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    

  public function addGamePref(GameTypes $gamePref)
  {
    $this->gamesPref[] = $gamePref;

    return $this;
  }

  public function removeGamePref(GameTypes $gamePref)
  {
    $this->gamesPref->removeElement($gamePref);
  }

  public function getGamesPref()
  {
    return $this->gamesPref;
  }



    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     *
     * @return self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     *
     * @return self
     */
    public function setBirthday($birthday)
    {

        $this->birthday = date('Y-m-d', strtotime($birthday));

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
    
}
