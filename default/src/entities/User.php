<?php
namespace simplon\entities;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity @ORM\Table(name="user")
 */
class User implements \JsonSerializable {
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue **/
    private $id;

    /** @ORM\Column(type="string") **/
    private $email;

    /** @ORM\Column(type="string") **/
    private $pass;

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'pass' => $this->pass,
        ];
    }


    public function __construct(string $email, 
                                string $pass, 
                                int $id = null) {
        $this->email = $email;
        $this->pass = $pass;
        $this->id = $id;
    }

    /**
     * Get the value of pass
     */ 
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @return  self
     */ 
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}