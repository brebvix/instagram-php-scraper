<?php

namespace InstagramScraper\Model;

use InstagramScraper\Endpoints;

/**
 * Class Media
 * @package InstagramScraper\Model
 */
class Media extends AbstractModel
{
    const TYPE_IMAGE = 'image';
    const TYPE_VIDEO = 'video';
    const TYPE_SIDECAR = 'sidecar';
    const TYPE_CAROUSEL = 'carousel';

    /**
     * @var string
     */
    protected $id = '';

    /**
     * @var string
     */
    protected $shortCode = '';

    /**
     * @var int
     */
    protected $createdTime = 0;

    /**
     * @var string
     */
    protected $type = '';

    /**
     * @var string
     */
    protected $link = '';

    /**
     * @var string
     */
    protected $imageLowResolutionUrl = '';

    /**
     * @var string
     */
    protected $imageThumbnailUrl = '';

    /**
     * @var string
     */
    protected $imageStandardResolutionUrl = '';

    /**
     * @var string
     */
    protected $imageHighResolutionUrl = '';

    /**
     * @var array
     */
    protected $squareImages = [];

    /**
     * @var array
     */
    protected $carouselMedia = [];

    /**
     * @var string
     */
    protected $caption = '';

    /**
     * @var bool
     */
    protected $isCaptionEdited = false;

    /**
     * @var bool
     */
    protected $isAd = false;

    /**
     * @var string
     */
    protected $videoLowResolutionUrl = '';

    /**
     * @var string
     */
    protected $videoStandardResolutionUrl = '';

    /**
     * @var string
     */
    protected $videoLowBandwidthUrl = '';

    /**
     * @var int
     */
    protected $videoViews = 0;

    /**
     * @var Account
     */
    protected $owner;

    /**
     * @var int
     */
    protected $ownerId = 0;

    /**
     * @var int
     */
    protected $likesCount = 0;

    /**
     * @var
     */
    protected $locationId;

    /**
     * @var string
     */
    protected $locationName = '';

    /**
     * @var string
     */
    protected $commentsCount = 0;

    /**
     * @var Comment[]
     */
    protected $comments = [];

    /**
     * @var bool
     */
    protected $commentsDisabled = false;

    /**
     * @var bool
     */
    protected $hasMoreComments = false;

    /**
     * @var string
     */
    protected $commentsNextPage = '';

    /**
     * @var Media[]|array
     */
    protected $sidecarMedias = [];

    /**
     * @var string
     */
    protected $locationSlug;

    /**
     * @param string $code
     *
     * @return int
     */
    public static function getIdFromCode(string $code): int
    {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_';
        $id = 0;
        for ($i = 0; $i < strlen($code); $i++) {
            $c = $code[$i];
            $id = $id * 64 + strpos($alphabet, $c);
        }
        return $id;
    }

    /**
     * @param string $id
     *
     * @return string
     */
    public static function getLinkFromId(string $id): string
    {
        $code = Media::getCodeFromId($id);
        return Endpoints::getMediaPageLink($code);
    }

    /**
     * @param string $id
     *
     * @return string
     */
    public static function getCodeFromId(string $id): String
    {
        $parts = explode('_', $id);
        $id = $parts[0];
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_';
        $code = '';
        while ($id > 0) {
            $remainder = $id % 64;
            $id = ($id - $remainder) / 64;
            $code = $alphabet{$remainder} . $code;
        };
        return $code;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getShortCode(): string
    {
        return $this->shortCode;
    }

    /**
     * @return int
     */
    public function getCreatedTime(): int
    {
        return $this->createdTime;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function getImageLowResolutionUrl(): string
    {
        return $this->imageLowResolutionUrl;
    }

    /**
     * @return string
     */
    public function getImageThumbnailUrl(): string
    {
        return $this->imageThumbnailUrl;
    }

    /**
     * @return string
     */
    public function getImageStandardResolutionUrl(): string
    {
        return $this->imageStandardResolutionUrl;
    }

    /**
     * @return string
     */
    public function getImageHighResolutionUrl(): string
    {
        return $this->imageHighResolutionUrl;
    }


    /**
     * @return array
     */
    public function getSquareImages(): array
    {
        return $this->squareImages;
    }


    /**
     * @return array
     */
    public function getCarouselMedia(): array
    {
        return $this->carouselMedia;
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->caption;
    }

    /**
     * @return bool
     */
    public function isCaptionEdited(): bool
    {
        return $this->isCaptionEdited;
    }

    /**
     * @return bool
     */
    public function isAd(): bool
    {
        return $this->isAd;
    }

    /**
     * @return string
     */
    public function getVideoLowResolutionUrl(): string
    {
        return $this->videoLowResolutionUrl;
    }

    /**
     * @return string
     */
    public function getVideoStandardResolutionUrl(): string
    {
        return $this->videoStandardResolutionUrl;
    }

    /**
     * @return string
     */
    public function getVideoLowBandwidthUrl(): string
    {
        return $this->videoLowBandwidthUrl;
    }

    /**
     * @return int
     */
    public function getVideoViews(): int
    {
        return $this->videoViews;
    }

    /**
     * @return int
     */
    public function getOwnerId(): int
    {
        return $this->ownerId;
    }

    /**
     * @return int
     */
    public function getLikesCount(): int
    {
        return $this->likesCount;
    }

    /**
     * @return mixed
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * @return string
     */
    public function getLocationName(): string
    {
        return $this->locationName;
    }

    /**
     * @return string
     */
    public function getCommentsCount(): string
    {
        return $this->commentsCount;
    }

    /**
     * @return bool
     */
    public function getCommentsDisabled(): bool
    {
        return $this->commentsDisabled;
    }

    /**
     * @return Comment[]
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @return bool
     */
    public function hasMoreComments(): bool
    {
        return $this->hasMoreComments;
    }

    /**
     * @return string
     */
    public function getCommentsNextPage(): string
    {
        return $this->commentsNextPage;
    }

    /**
     * @return Media[]|array
     */
    public function getSidecarMedias(): array
    {
        return $this->sidecarMedias;
    }

    /**
     * @return string
     */
    public function getLocationSlug(): string
    {
        return $this->locationSlug;
    }

    /**
     * @param $value
     * @param $prop
     * @param $arr
     *
     * @return void
     */
    protected function initPropertiesCustom($value, string $prop, array $arr): void
    {
        switch ($prop) {
            case 'id':
                $this->id = $value;
                break;
            case 'type':
                $this->type = $value;
                break;
            case 'created_time':
                $this->createdTime = (int)$value;
                break;
            case 'code':
                $this->shortCode = $value;
                $this->link = Endpoints::getMediaPageLink($this->shortCode);
                break;
            case 'link':
                $this->link = $value;
                break;
            case 'comments':
                $this->commentsCount = $arr[$prop]['count'];
                break;
            case 'comments_disabled':;
                $this->commentsDisabled = $arr[$prop];
                break;
            case 'likes':
                $this->likesCount = $arr[$prop]['count'];
                break;
            case 'display_resources':
                foreach ($value as $media) {
                    $mediasUrl[] = $media['src'];
                    switch ($media['config_width']) {
                        case 640:
                            $this->imageThumbnailUrl = $media['src'];
                            break;
                        case 750:
                            $this->imageLowResolutionUrl = $media['src'];
                            break;
                        case 1080:
                            $this->imageStandardResolutionUrl = $media['src'];
                            break;
                    }
                }
                break;
            case 'thumbnail_resources':
                $squareImagesUrl = [];
                foreach ($value as $squareImage) {
                    $squareImagesUrl[] = $squareImage['src'];
                }
                $this->squareImages = $squareImagesUrl;
                break;
            case 'display_url':
                $this->imageHighResolutionUrl = $value;
                break;
            case 'display_src':
                $this->imageHighResolutionUrl = $value;
                if (!isset($this->type)) {
                    $this->type = static::TYPE_IMAGE;
                }
                break;
            case 'thumbnail_src':
                $this->imageThumbnailUrl = $value;
                break;
            case 'carousel_media':
                $this->type = self::TYPE_CAROUSEL;
                $this->carouselMedia = [];
                foreach ($arr["carousel_media"] as $carouselArray) {
                    self::setCarouselMedia($arr, $carouselArray, $this);
                }
                break;
            case 'caption':
                $this->caption = $arr[$prop];
                break;
            case 'video_views':
                $this->videoViews = $value;
                $this->type = static::TYPE_VIDEO;
                break;
            case 'videos':
                $this->videoLowResolutionUrl = $arr[$prop]['low_resolution']['url'];
                $this->videoStandardResolutionUrl = $arr[$prop]['standard_resolution']['url'];
                $this->videoLowBandwidthUrl = $arr[$prop]['low_bandwidth']['url'];
                break;
            case 'video_resources':
                foreach ($value as $video) {
                    if ($video['profile'] == 'MAIN') {
                        $this->videoStandardResolutionUrl = $video['src'];
                    } elseif ($video['profile'] == 'BASELINE') {
                        $this->videoLowResolutionUrl = $video['src'];
                        $this->videoLowBandwidthUrl = $video['src'];
                    }
                }
                break;
            case 'location':
                $this->locationId = $arr[$prop]['id'];
                $this->locationName = $arr[$prop]['name'];
                $this->locationSlug = $arr[$prop]['slug'];
                break;
            case 'user':
                $this->owner = Account::create($arr[$prop]);
                break;
            case 'is_video':
                if ((bool)$value) {
                    $this->type = static::TYPE_VIDEO;
                }
                break;
            case 'video_url':
                $this->videoStandardResolutionUrl = $value;
                break;
            case 'video_view_count':
                $this->videoViews = $value;
                break;
            case 'caption_is_edited':
                $this->isCaptionEdited = $value;
                break;
            case 'is_ad':
                $this->isAd = $value;
                break;
            case 'taken_at_timestamp':
                $this->createdTime = $value;
                break;
            case 'shortcode':
                $this->shortCode = $value;
                $this->link = Endpoints::getMediaPageLink($this->shortCode);
                break;
            case 'edge_media_to_comment':
                if (isset($arr[$prop]['count'])) {
                    $this->commentsCount = (int)$arr[$prop]['count'];
                }
                if (isset($arr[$prop]['edges']) && is_array($arr[$prop]['edges'])) {
                    foreach ($arr[$prop]['edges'] as $commentData) {
                        $this->comments[] = Comment::create($commentData['node']);
                    }
                }
                if (isset($arr[$prop]['page_info']['has_next_page'])) {
                    $this->hasMoreComments = (bool)$arr[$prop]['page_info']['has_next_page'];
                }
                if (isset($arr[$prop]['page_info']['end_cursor'])) {
                    $this->commentsNextPage = (string)$arr[$prop]['page_info']['end_cursor'];
                }
                break;
            case 'edge_media_to_parent_comment':
                if (isset($arr[$prop]['count'])) {
                    $this->commentsCount = (int)$arr[$prop]['count'];
                }
                if (isset($arr[$prop]['edges']) && is_array($arr[$prop]['edges'])) {
                    foreach ($arr[$prop]['edges'] as $commentData) {
                        $this->comments[] = Comment::create($commentData['node']);
                    }
                }
                if (isset($arr[$prop]['page_info']['has_next_page'])) {
                    $this->hasMoreComments = (bool)$arr[$prop]['page_info']['has_next_page'];
                }
                if (isset($arr[$prop]['page_info']['end_cursor'])) {
                    $this->commentsNextPage = (string)$arr[$prop]['page_info']['end_cursor'];
                }
                break;
            case 'edge_media_preview_like':
                $this->likesCount = $arr[$prop]['count'];
                break;
            case 'edge_liked_by':
                $this->likesCount = $arr[$prop]['count'];
                break;
            case 'edge_media_to_caption':
                if (is_array($arr[$prop]['edges']) && !empty($arr[$prop]['edges'])) {
                    $first_caption = $arr[$prop]['edges'][0];
                    if (is_array($first_caption) && isset($first_caption['node'])) {
                        if (is_array($first_caption['node']) && isset($first_caption['node']['text'])) {
                            $this->caption = $arr[$prop]['edges'][0]['node']['text'];
                        }
                    }
                }
                break;
            case 'edge_sidecar_to_children':
                if (!is_array($arr[$prop]['edges'])) {
                    break;
                }
                foreach ($arr[$prop]['edges'] as $edge) {
                    if (!isset($edge['node'])) {
                        continue;
                    }

                    $this->sidecarMedias[] = static::create($edge['node']);
                }
                break;
            case 'owner':
                $this->owner = Account::create($arr[$prop]);
                break;
            case 'date':
                $this->createdTime = (int)$value;
                break;
            case '__typename':
                if ($value == 'GraphImage') {
                    $this->type = static::TYPE_IMAGE;
                } else if ($value == 'GraphVideo') {
                    $this->type = static::TYPE_VIDEO;
                } else if ($value == 'GraphSidecar') {
                    $this->type = static::TYPE_SIDECAR;
                }
                break;
        }
        if (!$this->ownerId && !is_null($this->owner)) {
            $this->ownerId = $this->getOwner()->getId();
        }
    }

    /**
     * @param array $mediaArray
     * @param array $carouselArray
     * @param Media $instance
     *
     * @return array
     */
    private static function setCarouselMedia(array $mediaArray, array $carouselArray, Media $instance): array
    {
        $carouselMedia = new CarouselMedia();
        $carouselMedia->setType($carouselArray['type']);

        if (isset($carouselArray['images'])) {
            $carouselImages = self::getImageUrls($carouselArray['images']['standard_resolution']['url']);
            $carouselMedia->setImageLowResolutionUrl($carouselImages['low']);
            $carouselMedia->setImageThumbnailUrl($carouselImages['thumbnail']);
            $carouselMedia->setImageStandardResolutionUrl($carouselImages['standard']);
            $carouselMedia->setImageHighResolutionUrl($carouselImages['high']);
        }

        if ($carouselMedia->getType() === self::TYPE_VIDEO) {
            if (isset($mediaArray['video_views'])) {
                $carouselMedia->setVideoViews($carouselArray['video_views']);
            }
            if (isset($carouselArray['videos'])) {
                $carouselMedia->setVideoLowResolutionUrl($carouselArray['videos']['low_resolution']['url']);
                $carouselMedia->setVideoStandardResolutionUrl($carouselArray['videos']['standard_resolution']['url']);
                $carouselMedia->setVideoLowBandwidthUrl($carouselArray['videos']['low_bandwidth']['url']);
            }
        }
        array_push($instance->carouselMedia, $carouselMedia);
        return $mediaArray;
    }

    /**
     * @param string $imageUrl
     *
     * @return array
     */
    private static function getImageUrls(string $imageUrl): array
    {
        $parts = explode('/', parse_url($imageUrl)['path']);
        $imageName = $parts[sizeof($parts) - 1];
        $urls = [
            'thumbnail' => Endpoints::INSTAGRAM_CDN_URL . 't/s150x150/' . $imageName,
            'low' => Endpoints::INSTAGRAM_CDN_URL . 't/s320x320/' . $imageName,
            'standard' => Endpoints::INSTAGRAM_CDN_URL . 't/s640x640/' . $imageName,
            'high' => Endpoints::INSTAGRAM_CDN_URL . 't/' . $imageName,
        ];
        return $urls;
    }

    /**
     * @return Account
     */
    public function getOwner(): Account
    {
        return $this->owner;
    }
}
