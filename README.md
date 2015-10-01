# Yii2 JSONify

Behavior that convert array to JSON before save data in model

## Install

Install via composer 

```shell
composer require emidia/yii2-jsonify
```

Or you may add dependency manually in composer.json:

```
 "emidia/yii2-jsonify": "*"
```


## How to use

To use JsonifyBehavior, insert the following code to your ActiveRecord class:

```php
use emidia\yii2\JsonifyBehavior;
public function behaviors()
{
    return [
        JsonifyBehavior::className(),
    ];
}
```

By default JsonifyBehavior fill `json_data` attribute from array into a json encoded string

If your attribute names are different, you may configure the [[attribute]] 
properties like the following:

```php
public function behaviors()
{
    return [
        [
            'class' => JsonifyBehavior::className(),
            'attribute' => 'data',
        ],
    ];
}
```

So, if set an array in model's attribute, this behavior will convert all data to JSON

```php
$model->setAttributes([
  'data' => [
    'id'=> 12,
    'title' => 'test''
  ]
]);
```
