# Yii2 JSONify

Behavior that convert array to JSON before save data in model

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
}`
``