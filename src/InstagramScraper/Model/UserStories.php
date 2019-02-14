<?php

namespace InstagramScraper\Model;

/**
 * Class UserStories
 * @package InstagramScraper\Model
 */
class UserStories extends AbstractModel
{
    /** @var  Account */
    protected $owner;

    /** @var  Story[] */
    protected $stories = [];

    /**
     * @return Account
     */
    public function getOwner(): Account
    {
        return $this->owner;
    }

    /**
     * @param Account $owner
     */
    public function setOwner(Account $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @param Story $story
     */
    public function addStory(Story $story): void
    {
        $this->stories[] = $story;
    }

    /**
     * @return Story[]
     */
    public function getStories(): array
    {
        return $this->stories;
    }

    /**
     * @param Story[] $stories
     */
    public function setStories(array $stories): void
    {
        $this->stories = $stories;
    }
}