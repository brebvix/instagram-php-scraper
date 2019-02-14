<?php
/**
 * File:    InitializerTrait.php
 * Project: instagram-php-scraper
 * User:    evgen
 * Date:    19.07.17
 * Time:    11:50
 */

namespace InstagramScraper\Traits;


trait InitializerTrait
{

    /**
     * @var bool
     */
    protected $isNew = true;

    /**
     * @var bool
     */
    protected $isLoaded = false;

    /**
     * @var bool - init data was empty
     */
    protected $isLoadEmpty = true;

    /**
     * @var bool
     */
    protected $isFake = false;

    /**
     * @var int
     */
    protected $isAutoConstruct = false;

    /**
     * @var int
     */
    protected $modified;

    /**
     * Array of initialization data
     *
     * @var array
     */
    protected $data = [];

    /**
     * @param array $props
     * @return void
     */
    protected function __construct(array $props = null)
    {
        $this->beforeInit();
        $this->modified = \time();
        if ($this->isAutoConstruct) {
            $this->initAuto();
        } elseif (empty($props)) {
            $this->initDefaults();
        } else {
            $this->init($props);
        }
        $this->afterInit();
    }

    /**
     * @return InitializerTrait
     */
    protected function beforeInit()
    {
        return $this;
    }

    /**
     * @return InitializerTrait
     */
    final protected function initAuto()
    {
        foreach ($this as $prop => $value) {
            if (isset(static::$initPropertiesMap[$prop]) and $methodOrProp = static::$initPropertiesMap[$prop] and \method_exists($this,
                    $methodOrProp)
            ) {
                //if there is method then use it firstly
                \call_user_func([$this, $methodOrProp], $value, $prop);
            }
        }
        $this->isNew = false;
        $this->isLoaded = true;
        $this->isLoadEmpty = false;

        return $this;
    }

    /**
     * @return InitializerTrait
     */
    protected function initDefaults()
    {
        return $this;
    }

    /**
     * @param array $props
     *
     * @return InitializerTrait
     */
    final protected function init(array $props)
    {
        //?reflection?
        foreach ($props as $prop => $value) {
            if (\method_exists($this, 'initPropertiesCustom')) {
                \call_user_func([$this, 'initPropertiesCustom'], $value, $prop, $props);
            } elseif (isset(static::$initPropertiesMap[$prop])) {
                $methodOrProp = static::$initPropertiesMap[$prop];
                if (\method_exists($this, $methodOrProp)) {
                    //if there is method then use it firstly
                    \call_user_func([$this, $methodOrProp], $value, $prop, $props);
                } elseif (\property_exists($this, $methodOrProp)) {
                    //if there is property then it just assign value
                    $this->{$methodOrProp} = $value;
                } else {
                    //otherwise fill help data array
                    //for following initialization
                    $this->data[$methodOrProp] = $value;
                    $this->data[$prop] = $value;
                }
            } else {
                //otherwise fill help data array
                $this->data[$prop] = $value;
            }
        }
        $this->isNew = false;
        $this->isLoaded = true;
        $this->isLoadEmpty = false;

        return $this;
    }

    /**
     * @return InitializerTrait
     */
    protected function afterInit()
    {
        return $this;
    }

    /**
     * @return InitializerTrait
     */
    public static function fake()
    {
        return static::create()->setFake(true);
    }

    /**
     * @param bool $value
     *
     * @return InitializerTrait
     */
    protected function setFake(bool $value = true)
    {
        $this->isFake = (bool)$value;

        return $this;
    }

    /**
     * @param array $params
     *
     * @return static
     */
    public static function create(array $params = null)
    {
        return new static($params);
    }

    /**
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return !$this->isLoadEmpty;
    }

    /**
     * @return bool
     */
    public function isFake(): bool
    {
        return $this->isFake;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $ret = [];
        $map = static::$initPropertiesMap;
        foreach ($map as $key => $init) {
            if (\property_exists($this, $key)) {
                //if there is property then it just assign value
                $ret[$key] = $this->{$key};
            } elseif (isset($this[$key])) {
                //probably array access
                $ret[$key] = $this[$key];
            } else {
                $ret[$key] = null;
            }
        }

        return $ret;
    }

    /**
     * @param $datetime
     *
     * @return InitializerTrait
     */
    protected function initModified($datetime)
    {
        $this->modified = \strtotime($datetime);

        return $this;
    }

    /**
     * @param string $date
     * @param string $key
     *
     * @return InitializerTrait
     */
    protected function initDatetime(string $date, string $key)
    {
        return $this->initProperty(\strtotime($date), $key);
    }

    /**
     * @param $value
     * @param $key
     *
     * @return InitializerTrait
     */
    protected function initProperty($value, $key)
    {
        $keys = \func_get_args();
        unset($keys[0]); //remove value
        if (\count($keys) > 1) {
            foreach ($keys as $key) {
                if (\property_exists($this, $key)) { //first found set
                    $this->{$key} = $value;

                    return $this;
                }
            }
        } elseif (\property_exists($this, $key)) {
            $this->{$key} = $value;
        }

        return $this;
    }

    /**
     * @param mixed $value
     * @param string $key
     *
     * @return InitializerTrait
     */
    protected function initBool($value, string $key)
    {
        return $this->initProperty(!empty($value), "is{$key}", $key);
    }

    /**
     * @param mixed $value
     * @param string $key
     *
     * @return InitializerTrait
     */
    protected function initInt($value, string $key)
    {
        return $this->initProperty((int)$value, $key);
    }

    /**
     * @param mixed $value
     * @param string $key
     *
     * @return InitializerTrait
     */
    protected function initFloat($value, string $key)
    {
        return $this->initProperty((float)$value, $key);
    }

    /**
     * @param string $rawData
     * @param string $key
     *
     * @return InitializerTrait
     */
    protected function initJsonArray(string $rawData, string $key)
    {
        $value = \json_decode($rawData, true, 512, JSON_BIGINT_AS_STRING);
        if (empty($value)) {
            //could not resolve -
            if ('null' === $rawData or '' === $rawData) {
                $value = [];
            } else {
                $value = (array)$rawData;
            }
        } else {
            $value = (array)$value;
        }

        return $this->initProperty($value, $key);
    }

    /**
     * @param mixed $value
     * @param string $key
     *
     * @return InitializerTrait
     */
    protected function initExplode($value, string $key)
    {
        return $this->initProperty(\explode(',', $value), "is{$key}", $key);
    }

}