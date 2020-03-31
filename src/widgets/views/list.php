<?php

/**
 * @var \yii\web\View $this
 * @var string $url
 * @var string $section
 * @var int $pageSize
 * @var array $pageSizes
 * @var array $lang
 * @var string $wrapperClass
 * @var string $innerClass
 */

use olegbolden\showNpages\helpers\PageSizeStorage;
use olegbolden\showNpages\widgets\PageSizeWidget;

echo '<div class="' . $wrapperClass . '">
    <span class="' . $innerClass . '">'
    . (isset($lang[PageSizeWidget::LANG_SHOW])
        ? $lang[PageSizeWidget::LANG_SHOW]
        : PageSizeWidget::LANG_DEFAULT[PageSizeWidget::LANG_SHOW])
    . ' <select name="pageSize">';

$options = "";
foreach ($pageSizes as $pageValue) {
    $options .= '<option value="' . $pageValue . '" ' . (($pageSize == $pageValue) ? 'selected' : "") . '>'
        . ($pageValue != PageSizeStorage::ALL_PAGES
            ? $pageValue
            : (isset($lang[PageSizeWidget::LANG_ALL])
                ? $lang[PageSizeWidget::LANG_ALL]
                : PageSizeWidget::LANG_DEFAULT[PageSizeWidget::LANG_ALL]))
        . '</option>';
}

echo "$options</select> "
    . (isset($lang[PageSizeWidget::LANG_ENTRIES])
        ? $lang[PageSizeWidget::LANG_ENTRIES]
        : PageSizeWidget::LANG_DEFAULT[PageSizeWidget::LANG_ENTRIES])
    . "</span></div>";

$js = <<<JS
    document.addEventListener("DOMContentLoaded", function () {
        let pageSize = document.querySelector('select[name="pageSize"]');
        pageSize.addEventListener("change", function () {

            const request = new XMLHttpRequest();
            const url = window.location.origin + '{$url}' + '?section={$section}' + '&pageSize=' + pageSize.value;

            request.open('GET', url);
            request.setRequestHeader('Content-Type', 'application/x-www-form-url');
            request.addEventListener("readystatechange", function () {
	            if (request.readyState === 4 && request.status === 200) {
                    document.location.reload();
                }
            });
            request.send();
        })
    });
JS;

$this->registerJs($js, \yii\web\View::POS_END);
