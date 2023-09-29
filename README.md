Page size selector widget (for DetailView, GridView etc.)
=================================
By default, there is no page size selector for Yii2 in multiple page listings 
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
php composer.phar require --prefer-dist olegbolden/yii2-show-n-pages "*"
```

or add

```
"olegbolden/yii2-show-n-pages": "*"
```

to the require section of your `composer.json` file.


Usage
-----

1. First step is to specify actual page size provided by this widget for your data provider

```php
$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => PageSizeWidget::getPageSize([
            'section'   => 'statistics',
            'pageSizes' => [25, 50, 100],
        ]),
    ],
]);
```
`'section'` parameter specifies section identifier for the corresponding widget because there are may be several places in your site with different PageSizeWidget instances having their own page settings so widget needs these identifiers to distinguish between them. In case you use the only instance then section identifier can be omitted and defaults to 'main'.

`'pageSizes'` parameter specifies custom set of predefined page sizes in case you are not satisfied with the default one for corresponding data provider. Default is [10, 25, 50, 100, All] and can be also omitted. It is useful if you want to exclude option "All" among page sizes in case your data set is very big and there is no sense to show all items on the only page.

2. Now you can insert the Widget in your View code by

```php
<?= PageSizeWidget::widget($options); ?>
```

Options
-----
The following arrayed options are available 

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

It's important, that each `'section'` specified here MUST have the same `'section'` in corresponding data provider pagination setup described above. 
```php
'section' => 'statistics'
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
