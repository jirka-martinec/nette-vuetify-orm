<?php
/**
 * Created by PhpStorm.
 * User: jirka.martinec
 * Date: 27.01.2021
 * Time: 22:49
 */

namespace App\Model\Entities;


class User extends BaseEntity
{
    /**
     * @var string
     */
    private string $email;
    /**
     * @var string
     */
    private string $firstName;
    /**
     * @var string
     */
    private string $surname;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return User
     */
    public function setSurname(string $surname): User
    {
        $this->surname = $surname;
        return $this;
    }
}