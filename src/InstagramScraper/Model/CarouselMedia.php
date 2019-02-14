<?php

namespace InstagramScraper\Model;

/**
 * Class CarouselMedia
 * @package InstagramScraper\Model
 */
class CarouselMedia
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $imageLowResolutionUrl;

    /**
     * @var string
     */
    private $imageThumbnailUrl;

    /**
     * @var string
     */
    private $imageStandardResolutionUrl;

    /**
     * @var string
     */
    private $imageHighResolutionUrl;

    /**
     * @var string
     */
    private $videoLowResolutionUrl;

    /**
     * @var string
     */
    private $videoStandardResolutionUrl;

    /**
     * @var string
     */
    private $videoLowBandwidthUrl;

    /**
     * @var int
     */
    private $videoViews;

    /**
     * CarouselMedia constructor.
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return CarouselMedia
     */
    public function setType(string $type): CarouselMedia
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageLowResolutionUrl(): string
    {
        return $this->imageLowResolutionUrl;
    }

    /**
     * @param string $imageLowResolutionUrl
     *
     * @return CarouselMedia
     */
    public function setImageLowResolutionUrl(string $imageLowResolutionUrl): CarouselMedia
    {
        $this->imageLowResolutionUrl = $imageLowResolutionUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageThumbnailUrl(): string
    {
        return $this->imageThumbnailUrl;
    }

    /**
     * @param string $imageThumbnailUrl
     *
     * @return CarouselMedia
     */
    public function setImageThumbnailUrl(string $imageThumbnailUrl): CarouselMedia
    {
        $this->imageThumbnailUrl = $imageThumbnailUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageStandardResolutionUrl(): string
    {
        return $this->imageStandardResolutionUrl;
    }

    /**
     * @param string $imageStandardResolutionUrl
     *
     * @return CarouselMedia
     */
    public function setImageStandardResolutionUrl(string $imageStandardResolutionUrl): CarouselMedia
    {
        $this->imageStandardResolutionUrl = $imageStandardResolutionUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageHighResolutionUrl(): string
    {
        return $this->imageHighResolutionUrl;
    }

    /**
     * @param string $imageHighResolutionUrl
     *
     * @return CarouselMedia
     */
    public function setImageHighResolutionUrl(string $imageHighResolutionUrl): CarouselMedia
    {
        $this->imageHighResolutionUrl = $imageHighResolutionUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideoLowResolutionUrl(): string
    {
        return $this->videoLowResolutionUrl;
    }

    /**
     * @param string $videoLowResolutionUrl
     *
     * @return CarouselMedia
     */
    public function setVideoLowResolutionUrl(string $videoLowResolutionUrl): CarouselMedia
    {
        $this->videoLowResolutionUrl = $videoLowResolutionUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideoStandardResolutionUrl(): string
    {
        return $this->videoStandardResolutionUrl;
    }

    /**
     * @param string $videoStandardResolutionUrl
     *
     * @return CarouselMedia
     */
    public function setVideoStandardResolutionUrl(string $videoStandardResolutionUrl): CarouselMedia
    {
        $this->videoStandardResolutionUrl = $videoStandardResolutionUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideoLowBandwidthUrl(): string
    {
        return $this->videoLowBandwidthUrl;
    }

    /**
     * @param string $videoLowBandwidthUrl
     *
     * @return CarouselMedia
     */
    public function setVideoLowBandwidthUrl(string $videoLowBandwidthUrl): CarouselMedia
    {
        $this->videoLowBandwidthUrl = $videoLowBandwidthUrl;
        return $this;
    }

    /**
     * @return int
     */
    public function getVideoViews(): int
    {
        return $this->videoViews;
    }

    /**
     * @param int $videoViews
     *
     * @return CarouselMedia
     */
    public function setVideoViews(int $videoViews): CarouselMedia
    {
        $this->videoViews = $videoViews;
        return $this;
    }

}
