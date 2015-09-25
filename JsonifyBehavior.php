<?php

/**
 * @link https://www.github.com/emidia/yii2-jsonify
 * @copyright Copyright (c) 2015 E-midia Informações
 * @license https://opensource.org/licenses/MIT
 */

namespace emidia\yii2\behaviors;

use yii\behaviors\AttributeBehavior;
use yii\base\InvalidConfigException;
use yii\db\BaseActiveRecord;

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
		BaseActiveRecord::EVENT_BEFORE_VALIDATE => $this->attribute,
	    ];
	}

	if ($this->attribute === null) {
	    throw new InvalidConfigException('Either "attribute" or "value" property must be specified.');
	}
    }

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
	$owner = $this->owner;
	$json = '{}';

	if (!empty($owner->{$this->attribute})) {
	    $json = json_encode($owner->{$this->attribute}, $this->jsonOptions, $this->jsonDeep);
	}

	return $json;
    }

}
