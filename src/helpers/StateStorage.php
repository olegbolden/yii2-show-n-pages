<?php

namespace olegbolden\showNpages\helpers;

use yii\web\Session;

/**
 * State storage class
 */
class StateStorage implements StateStorageInterface
{

    /** @var Session */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param mixed $key
     * @param null $defaultValue
     *
     * @return mixed
     */
    public function get($key, $defaultValue = null)
    {
        return $this->session->get($key, $defaultValue);
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->session->set($key, $value);
    }
}
