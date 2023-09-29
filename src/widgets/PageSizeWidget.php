<?php

namespace olegbolden\showNpages\widgets;

use yii\base\Widget;
use olegbolden\showNpages\helpers\PageSizeStorage;

/**
 * Dropdown selector to set page size in DataTables-like style
 */
class PageSizeWidget extends Widget
{
    const LANG_SHOW    = 'show';
    const LANG_ENTRIES = 'entries';
    const LANG_ALL     = 'all';

    /**
     * Default  translations
     *
     * @var array
     */
    const LANG_DEFAULT = [
        self::LANG_SHOW    => 'Show',
        self::LANG_ENTRIES => 'entries',
        self::LANG_ALL     => 'All',
    ];

    /**
     * Translations
     *
     * @var array
     */
    public $lang = self::LANG_DEFAULT;

    /**
     * Url to set page size
     *
     * @var string
     */
    public $url = '/show-n-pages/set-page';

    /**
     * Optional parameter to distinguish between different sections if necessary
     *
     * @var string
     */
    public $section = PageSizeStorage::DEFAULT_SECTION;

    /**
     * Class for dropdown selector itself
     *
     * @var string
     */
    public $innerClass = '';

    /**
     * Wrapper class for dropdown selector
     *
     * @var string
     */
    public $wrapperClass = '';

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function run()
    {
        return $this->render('list', [
            'url'          => $this->url,
            'section'      => $this->section,
            'lang'         => $this->lang,
            'pageSizeInfo' => PageSizeStorage::getPageSizeInfo($this->section),
            'wrapperClass' => $this->wrapperClass,
            'innerClass'   => $this->innerClass,
        ]);
    }

    /**
     * Initialization of widget storage with specified configuration
     *
     * @param $config
     *
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public static function getPageSize($config = ['section' => 'main', 'pageSizes' => PageSizeStorage::DEFAULT_PAGE_SIZES])
    {
        return PageSizeStorage::updatePageSizeInfo(
            isset($config['section']) ? $config['section'] : null,
            isset($config['pageSizes']) ? $config['pageSizes'] : null
        )['pageSize'];
    }
}
