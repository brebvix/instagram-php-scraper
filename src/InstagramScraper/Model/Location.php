<?php

namespace InstagramScraper\Model;


class Location extends AbstractModel
{
    /**
     * @var array
     */
    protected static $initPropertiesMap = [
        'id' => 'id',
        'has_public_page' => 'hasPublicPage',
        'name' => 'name',
        'slug' => 'slug',
        'lat' => 'lat',
        'lng' => 'lng',
        'modified' => 'modified'
    ];
    /**
     * @var int
     */
    protected $id;
    /**
     * @var bool
     */
    protected $hasPublicPage;
    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $slug;
    /**
     * @var
     */
    protected $lng;
    /**
     * @var
     */
    protected $lat;
    /**
     * @var bool
     */
    protected $isLoaded = false;

    /**
     * @var
     */
    protected $modified;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getHasPublicPage(): bool
    {
        return $this->hasPublicPage;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }
}
