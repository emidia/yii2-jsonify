<?php

/**
 * @link https://www.github.com/emidia/yii2-jsonify
 * @copyright Copyright (c) 2015 E-midia Informações
 * @license https://opensource.org/licenses/MIT
 */

namespace emidia\yii2\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\base\InvalidCallException;
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * Behavior that convert array to JSON before save data in model
 * 
 * To use JsonifyBehavior, insert the following code to your ActiveRecord class:
 *
 * ```php
 * use emidia\yii2\JsonifyBehavior;
 *
 * public function behaviors()
 * {
 *     return [
 *         JsonifyBehavior::className(),
 *     ];
 * }
 * ```
 * 
 * By default JsonifyBehavior fill `json_data` attribute from array into a json encoded string
 * 
 * If your attribute names are different, you may configure the [[attribute]] 
 * properties like the following:
 *
 * ```php
 *
 * public function behaviors()
 * {
 *     return [
 *         [
 *             'class' => JsonifyBehavior::className(),
 *             'attribute' => 'data',
 *         ],
 *     ];
 * }
 * 
 * @author Rodrigo Zani <rodrigo.zhs@gmail.com>
 * 
 */
class JsonifyBehavior extends AttributeBehavior
{

    /**
     * @var string The attribute that will receive the JSON value
     */
    public $attribute = 'json_data';

    /**
     *
     * @var JSON constants
     * 
     * The behaviour of these constants is described on the JSON constants page below.
     * http://php.net/manual/en/json.constants.php
     * 
     */
    public $jsonOptions = 0;

    /**
     * @var integer The 'deep' parameterin json_encode.
     * Set the maximum depth. Must be greater than zero
     */
    public $jsonDeep = 512;

    /**
     * @inheritdoc
     */
    public function init()
    {
	parent::init();

	if (empty($this->attributes)) {
	    $this->attributes = [
		BaseActiveRecord::EVENT_BEFORE_INSERT => $this->attribute,
		BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->attribute,
	    ];
	}
    }

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
	return json_encode($this->value, $this->jsonOptions, $this->jsonDeep);
    }

}
