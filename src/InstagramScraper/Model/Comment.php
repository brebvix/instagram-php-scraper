<?php

namespace InstagramScraper\Model;


class Comment extends AbstractModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var Account
     */
    protected $owner;

    /**
     * @var bool
     */
    protected $isLoaded = false;

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
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return Account
     */
    public function getOwner(): Account
    {
        return $this->owner;
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
            case 'created_at':
                $this->createdAt = (string) $value;
                break;
            case 'text':
                $this->text = (string) $value;
                break;
            case 'owner':
                $this->owner = Account::create($value);
                break;
        }
    }

}