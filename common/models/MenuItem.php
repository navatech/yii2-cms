<?php

namespace common\models;

use navatech\language\Translate;
use Yii;

/**
 * This is the model class for table "menu_item".
 *
 * @property integer $id
 * @property integer $menu_id
 * @property string $icon
 * @property string $parent_id
 * @property integer $level
 * @property string $url
 * @property integer $sort_order
 * @property integer $status
 */
class MenuItem extends Model
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'icon', 'url'], 'required'],
            [['menu_id', 'parent_id', 'level', 'sort_order', 'status'], 'integer'],
            [['icon', 'url'], 'string', 'max' => 255],
	        [
		        [
			        'icon',
			        'url',
			        'name',
			        'name_' . Yii::$app->language,
		        ],
		        'safe',
	        ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_id' => 'Menu',
            'icon' => 'Icon',
            'parent_id' => Translate::menu_parent(),
            'level' => Translate::level(),
            'url' => 'Url',
            'sort_order' => Translate::sort_order(),
            'status' => Translate::status(),
        ];
    }

	public function behaviors($attributes = null) {
		$attributes = [
			'name',
		];
		$behaviors  = parent::behaviors($attributes);
		return $behaviors;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMenu() {
		return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMenuItemLangs() {
		return $this->hasMany(MenuItemLang::className(), ['menu_item_id' => 'id']);
	}

	public static function getAllmenuitem() {
		$menuitems     = MenuItem::findAll(['status'=>1]);
		$response = [];
		foreach ($menuitems as $menuitem) {
			$response[$menuitem->id] = $menuitem->name;
		}
		return $response;
	}


}
