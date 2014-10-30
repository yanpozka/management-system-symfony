<?php
namespace GEPedag\EntidadesBundle\Entity;

use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="GEPedag\EntidadesBundle\Entity\UserRepository")
 * @UniqueEntity(fields="username", message="El nombre de usuario ya esta en uso.")
 */
class User implements UserInterface
{

    private static $saltpass = '-*uN4BueNA;*-*c4q1e_c0nT1en3.eSpAci0S:y[cos4s]_*-p3d4G';

    public function __toString()
    {
        return $this->username;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
//        if (null !== $this->imgavatar) {
//            // haz lo que quieras para generar un nombre único
//            $this->file = $this->imgavatar;
//            $this->imgavatar = 'u' . uniqid() . '.' . $this->imgavatar->guessClientExtension();
//        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function uploadImg()
    {
//        if (null === $this->file /* || !($this->imgavatar instanceof Symfony\Component\HttpFoundation\File\UploadedFile) */) {
//            return;
//        }
//        // aquí lanzar una excepción si el archivo no se puede mover
//        $this->file->move($this->getUploadRootDir(), $this->imgavatar);
//        unset($this->file);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
//        if (($file = $this->getAbsolutePath())) {
//            unlink($file);
//        }
    }

    private $file;
    private $avatar;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(name="username", type="string", length=255, nullable=false, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @ORM\Column(name="status", type="smallint", nullable=false)
     */
    private $status;

    /**
     * @ORM\Column(name="last_login", type="datetime", nullable=false)
     */
    private $lastLogin;

    /**
     * @ORM\Column(name="last_logout", type="datetime", nullable=true)
     */
    private $lastLogout;

    /**
     * @ORM\Column(name="creado", type="datetime", nullable=false)
     */
    private $creado;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    //*** SETTS y GETS    ***//
    public function setCreado($creado)
    {
        $this->creado = $creado;
        return $this;
    }

    public function getCreado()
    {
        return $this->creado;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setLastLogin(\DateTime $lastLogin)
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLastLogout(\DateTime $lastLogout)
    {
        $this->lastLogout = $lastLogout;
    }

    public function getLastLogout()
    {
        return $this->lastLogout;
    }


    /**
     * Alternatively, the roles might be stored on a ``roles`` property,
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return User::$saltpass;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }
}