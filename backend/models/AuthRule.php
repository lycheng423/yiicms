<?php

namespace backend\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%auth_rule}}".
 *
 * @property string $name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthItem[] $authItems
 */
class AuthRule extends ActiveRecord
{
    /**
     * 规则类名
     *
     * @var
     */
    protected $auth_rule;

    /**
     * 角色授权用户类
     *
     * @var
     */
    protected $auth_assignment;

    /**
     * 角色路由类
     *
     * @var
     */
    protected $auth_item;

    /**
     * 路由授权角色类
     *
     * @var
     */
    protected $auth_item_child;

    /**
     * RBAC规则类名
     *
     * @var
     */
    public $className;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_rule}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'className'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['className'], 'classExists']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '规则名称',
            'className' => '规则类名',
            'data' => '序列化数据',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function init()
    {
        $this->auth_rule = AuthRule::className();
        $this->auth_assignment = AuthAssignment::className();
        $this->auth_item = AuthItem::className();
        $this->auth_item_child = AuthItemChild::className();

        parent::init();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItems()
    {
        return $this->hasMany($this->auth_item, ['rule_name' => 'name']);
    }

    /**
     * 行为
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * 验证类名称是否符合规则
     */
    public function classExists()
    {
        if (!class_exists($this->className))
        {
            $message = "没有发找到类'{$this->className}'";
            $this->addError('className', $message);
            return;
        }

        if (!is_subclass_of($this->className, Rule::className()))
        {
            $message = "'{$this->className}'必须是 RBAC 规则";
            $this->addError('className', $message);
        }
    }

    /**
     * @param $data
     * @return bool|string
     */
    public static function getClassName($data)
    {
        if(!empty($data))
        {
            $data = unserialize($data);
            return get_class($data);
        }

        return false;
    }

    /**
     * @return array
     */
    public static function getRoutes()
    {
        return ArrayHelper::map(self::find()->asArray()->all(), 'name', 'name');
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $rule = new $this->className;
        $this->data = serialize($rule);

        return parent::beforeSave($insert);
    }

}
