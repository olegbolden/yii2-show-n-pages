<?php

namespace olegbolden\showNpages\widgets;

use yii\base\Widget;
use olegbolden\showNpages\helpers\PageSizeStorage;

/**
 * Dropdown selector to set page size in DataTables-like style
 */
class PageSizeWidget extends Widget
{
    const LANG_SHOW = 'show';
    const LANG_ENTRIES = 'entries';
    const LANG_ALL = 'all';

    /**
     * Default  translations
     * @var array
     */
    const LANG_DEFAULT = [
        self::LANG_SHOW    => 'Show',
        self::LANG_ENTRIES => 'entries',
        self::LANG_ALL     => 'All',
    ];

    /**
     * Translations
     * @var array
     */
    public $lang = self::LANG_DEFAULT;

    /**
     * Url to set page size
     * @var string
     */
    public $url = '/show-n-pages/set-page';

    /**
     * Optional parameter to distinguish between different sections if necessary
     * @var string
     */
    public $section = 'main';

    /**
     * Set of page size values for dropdown selector
     * @var array
     */
    public $pageSizes = PageSizeStorage::PAGE_SIZES;

    /**
     * Class for dropdown selector itself
     * @var string
     */
    public $innerClass = '';

    /**
     * Wrapper class for dropdown selector
     * @var string
     */
    public $wrapperClass = '';

    /**
     * @var PageSizeStorage
     */
    private $pageSizeStorage;

    public function __construct(PageSizeStorage $pageSizeStorage, $config = [])
    {
        parent::__construct($config);
        $this->pageSizeStorage = $pageSizeStorage;
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function run()
    {
        $pageSizeStorage = $this->pageSizeStorage;
        return $this->render('list', [
            'url'          => $this->url,
            'section'      => $this->section,
            'lang'         => $this->lang,
            'pageSize'     => $pageSizeStorage::getPageSize($this->section),
            'pageSizes'    => $this->pageSizes,
            'wrapperClass' => $this->wrapperClass,
            'innerClass'   => $this->innerClass,
        ]);
    }
}
