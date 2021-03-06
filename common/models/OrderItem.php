<?php
namespace common\models;

use navatech\language\Translate;

/**
 * This is the model class for table "order_item".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $quantity
 * @property integer $price
 */
class OrderItem extends Model {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'order_item';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[
					'id',
					'order_id',
					'product_id',
					'quantity',
					'price',
				],
				'required',
			],
			[
				[
					'id',
					'order_id',
					'product_id',
					'quantity',
					'price',
				],
				'integer',
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'         => 'No.',
			'order_id'   => Translate::order(),
			'product_id' => Translate::product(),
			'quantity'   => Translate::quantity(),
			'price'      => Translate::price(),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrder() {
		return $this->hasOne(Order::className(), ['id' => 'order_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProduct() {
		return $this->hasOne(Product::className(), ['id' => 'product_id']);
	}
}
