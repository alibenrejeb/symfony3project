<?php
namespace OC\UserBundle\Service;

class Service
{
    public function getUser($usename)
    {
        return "username";
    }

    public function authenticate($user, $presentedPassword)
    {
        return true;
    }
}