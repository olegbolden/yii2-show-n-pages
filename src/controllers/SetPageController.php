<?php

namespace olegbolden\showNpages\controllers;

use yii\web\Controller;
use olegbolden\showNpages\helpers\PageSizeStorage;

class SetPageController extends Controller
{
    /**
     * @var PageSizeStorage
     */
    private $pageSizeStorage;

    public function __construct($id, $module, PageSizeStorage $pageSizeStorage, $config = [])
    {
        $this->pageSizeStorage = $pageSizeStorage;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex($section, $pageSize)
    {
        $pageStorage = $this->pageSizeStorage;
        $pageStorage::setPageSize($section, $pageSize);
    }
}
