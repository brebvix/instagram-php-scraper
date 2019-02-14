<?php

namespace InstagramScraper\Model;

/**
 * Class Tag
 * @package InstagramScraper\Model
 */
class Tag extends AbstractModel
{
    /**
     * @var array
     */
    protected static $initPropertiesMap = [
        'media_count' => 'mediaCount',
        'name' => 'name',
        'id' => 'initInt',
    ];
    /**
     * @var int
     */
    protected $mediaCount = 0;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getMediaCount(): int
    {
        return $this->mediaCount;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}