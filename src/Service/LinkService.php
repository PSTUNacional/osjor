<?php

namespace OSJ\Service;

use OSJ\Repository\LinkRepository;

class LinkService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new LinkRepository;
    }

    private function createUniqueToken($length)
    {
        $char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $char = str_shuffle($char);
        for($i = 0, $rand = '', $l = strlen($char) - 1; $i < $length; $i ++) {
            $rand .= $char[mt_rand(0, $l)];
        }

        return $rand;
    }

    private function checkUniqueToken($token)
    {
        $result = $this->repository->getByToken($token);
        if(sizeof($result) !== 0)
        {
            return $result;
        } else {
            return true;
        }
    }

    private function checkURL($url)
    {
        $result = $this->repository->getByURL($url);
        if(sizeof($result) !== 0)
        {
            return $result;
        } else {
            return false;
        }
    }

    public function getURL($token)
    {
        $url = $this->repository->getByToken($token);
        return $url['url'];
    }

    public function registerLink($url)
    {
        $urlExists = $this->checkURL($url);
        if($urlExists == false)
        {
            $isUnique = false;
            while($isUnique !== true)
            {
                $token = $this->createUniqueToken(6);
                $isUnique = $this->checkUniqueToken($token);
            }
            $this->repository->createLink($token, $url);
            return $token;
        } else {
            return $urlExists['token'];
        }

    }

}