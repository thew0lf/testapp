<?php

namespace App\Form\Model;

use App\Document\User;

class Login
{
    /**
     * @Assert\Type(type="App\Document\User")
     */
    protected $user;

    /**
     * @Assert\NotBlank()
     * @Assert\True()
     */
    protected $rememberMe;

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getRememberMe()
    {
        return $this->rememberMe;
    }

    /**
     * @param mixed $rememberMe
     */
    public function setRememberMe($rememberMe): void
    {
        $this->rememberMe = $rememberMe;
    }


}