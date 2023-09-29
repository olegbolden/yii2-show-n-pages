<?php

namespace app\helpers;

namespace olegbolden\showNpages\helpers;

class PageSizeStorage
{
    const ALL_PAGES = 1000000;

    const DEFAULT_SECTION = 'main';

    /** List of predefined page sizes */
    const DEFAULT_PAGE_SIZES = [10, 25, 50, 100, self::ALL_PAGES];

    /**
     * Updates and retrieves actual page size info, configured at early stage to set pagination for data providers
     *
     * @param string $section
     *
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public static function updatePageSizeInfo($section = self::DEFAULT_SECTION, $pageSizes = null)
    {
        // If this function's 'section' parameter is initialized with null then default value in signature is ignored
        $section = !empty($section) ? $section : self::DEFAULT_SECTION;

        $stateStorageInstance = \Yii::$container->get(StateStorageInterface::class);
        $valuesFromStorage = $stateStorageInstance->get('pageStorage.' . $section);

        if (!$valuesFromStorage) {
            $valuesToStorage = [
                'pageSize'  => isset($pageSizes[0]) ? $pageSizes[0] : self::DEFAULT_PAGE_SIZES[0],
                'pageSizes' => !empty($pageSizes) ? $pageSizes : self::DEFAULT_PAGE_SIZES,
            ];
            $stateStorageInstance->set('pageStorage.' . $section, $valuesToStorage);
            return $valuesToStorage;
        }

        // When pageSizes setting was changed we have to reset storage
        if ($valuesFromStorage['pageSizes'] != $pageSizes) {
            // and is not empty
            if (!empty($pageSizes)) {
                $valuesToStorage = [
                    'pageSize'  => $pageSizes[0],
                    'pageSizes' => $pageSizes,
                ];
                // otherwise replace with default values
            } else {
                $valuesToStorage = [
                    'pageSize'  => self::DEFAULT_PAGE_SIZES[0],
                    'pageSizes' => self::DEFAULT_PAGE_SIZES,
                ];
            }
            $stateStorageInstance->set('pageStorage.' . $section, $valuesToStorage);
            return $valuesToStorage;
        }

        return $valuesFromStorage;
    }

    /**
     * Just retrieves page info from storage to show as it is
     *
     * @param $section
     *
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public static function getPageSizeInfo($section)
    {
        $stateStorageInstance = \Yii::$container->get(StateStorageInterface::class);
        return $stateStorageInstance->get('pageStorage.' . $section);
    }

    /**
     * Only used for setting pageSize by means of selector
     *
     * @param     $section
     * @param int $pageSize
     */
    public static function setPageSize($section, $pageSize)
    {
        $stateStorageInstance = \Yii::$container->get(StateStorageInterface::class);
        $valueFromStorage = $stateStorageInstance->get('pageStorage.' . $section);
        $valueFromStorage['pageSize'] = $pageSize;
        $stateStorageInstance->set('pageStorage.' . $section, $valueFromStorage);
    }
}
