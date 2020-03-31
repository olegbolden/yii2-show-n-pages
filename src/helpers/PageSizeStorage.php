<?php

namespace app\helpers;

namespace olegbolden\showNpages\helpers;

class PageSizeStorage
{
    const ALL_PAGES = 1000000;

    /** List of predefined page sizes */
    const PAGE_SIZES = [10, 25, 50, 100, self::ALL_PAGES];

    /** @var StateStorageInterface */
    private static $stateStorage;

    /**
     * @param StateStorageInterface $stateStorage
     */
    public function __construct(StateStorageInterface $stateStorage)
    {
        self::$stateStorage = $stateStorage;
    }

    /**
     * Actual page size getter (e.g. for data providers)
     *
     * @param string $section
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public static function getPageSize($section = 'main')
    {
        $stateStorageInstance = (self::$stateStorage !== null)
            ? self::$stateStorage
            : \Yii::$container->get(StateStorageInterface::class);
        return ($stateStorageInstance->get('pageStorage.' . $section) !== null)
            ? $stateStorageInstance->get('pageStorage.' . $section)
            : self::PAGE_SIZES[0];
    }

    /**
     * @param $section
     * @param int $pageSize
     */
    public static function setPageSize($section, $pageSize)
    {
        self::$stateStorage->set('pageStorage.' . $section, $pageSize);
    }
}
