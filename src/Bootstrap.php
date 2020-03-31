<?php

namespace olegbolden\showNpages;

use yii\base\BootstrapInterface;
use olegbolden\showNpages\helpers\StateStorage;
use olegbolden\showNpages\helpers\StateStorageInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        /*
         * Module auto registration
         */
        $app->setModule('show-n-pages', [
            'class' => Module::class
        ]);

        /*
         * Registration of dependencies
         */
        \Yii::$container->setSingleton(StateStorageInterface::class, [
            'class' => StateStorage::class,
        ], [
            \Yii::$app->session
        ]);
    }
}
