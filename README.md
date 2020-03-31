Page size selector widget (for DetailView, GridView etc.)
=================================
By default there is no page size selector for Yii2 in multi page listings 
created with widgets like DetailView etc. This extension adds such a functionality 
in popular javascript DataTables-like style without jQuery.

The extension is simple to use and fully customizable to fit your page layout. 

Compatibility
------------
```
PHP version >=5.6
All modern browsers and IE.
Yii2 versions >=2.0.*
```

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist olegbolden/yii2-show-n-pages-widget "*"
```

or add

```
"olegbolden/yii2-show-n-pages-widget": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your View code by:

```php
<?= \olegbolden\showNpages\widgets\PageSizeWidget::widget([options]); ?>
```
Actual page size for your data provider is available with the following call

```php
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => \olegbolden\showNpages\helpers\PageSizeStorage::getPageSize()
    ]
]);
```
Options
-----
The following options are available 

**lang**

Language settings
```php
'lang' => [
    PageSizeWidget::LANG_SHOW    => 'Показать',
    PageSizeWidget::LANG_ENTRIES => 'записей',
    PageSizeWidget::LANG_ALL     => 'Все',
]
```

**section**

Optional parameter to distinguish between widgets for different sections 
of your site to set independent page size settings for each.
```php
'section' => 'statistics'
```

**pageSizes**

Custom set of predefined page sizes in case you are not satisfied with the default one.

It is useful if you want to exclude option "all" among page sizes in case your 
data set is very big and there is no sense to show all items on the only page.
```php
'pageSizes' => [10, 50, 100]
```

**wrapperClass / innerClass**

Style classes for the widget to fit in your page.

For example, styles specified as
```php
'wrapperClass' => 'pull-right',
'innerClass' => 'pageSelector'
```
will give the following layout
```html
<div class="pull-right">
    <span class="pageSelector">Show <select name="pageSize">
            <option value="10">10</option>
            ...
            <option value="1000000">All</option>
        </select> items</span>
</div>
```
