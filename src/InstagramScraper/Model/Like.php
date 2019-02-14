<?php

namespace InstagramScraper\Model;


class Like extends AbstractModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Account
     */
    protected $username;

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
    public function getUserName(): string
    {
        return $this->username;
    }

    /**
     * @param $value
     * @param $prop
     */
    protected function initPropertiesCustom($value, $prop)
    {
        switch ($prop) {
            case 'id':
                $this->id = (int) $value;
                break;
            case 'username':
                $this->username = (string) $value;
                break;
        }
    }

}