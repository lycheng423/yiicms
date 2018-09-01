<?php
/**
 * 多图上传
 */
namespace backend\widgets\webuploader;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\InputWidget;
use backend\widgets\webuploader\assets\ImageAsset;
use backend\widgets\webuploader\assets\WebuploaderAsset;

/**
 * 多图上传
 */
class Image extends InputWidget
{

    /**
     * 基础属性
     * @var array
     */
    public $options = [];

    /**
     * 更多属性
     * @var array
     */
    public $pluginOptions = [];

    /**
     * 盒子ID
     * @var
     */
    public $boxId;

    /**
     * 默认名称
     * @var string
     */
    public $name = 'fileinput';

    /**
     * @var string
     */
    public $value = '';

    /**
     * 隐藏按钮
     */
    protected $hiddenInput;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $_options = [
            'multiple' => true,
            'mimeTypes' => 'image/*',
            'extensions' => 'gif,jpg,jpeg,bmp,png',
        ];

        $_pluginOptions = [
            'uploadUrl' => Url::to([Yii::$app->params['filesUpload']['imagesUrl']]),
            'uploadMaxSize' => Yii::$app->params['imagesUpload']['maxSize'],
            'previewWidth' => '112',
            'previewHeight' => '112',
        ];

        $this->options = ArrayHelper::merge($_options, $this->options);
        $this->pluginOptions = ArrayHelper::merge($_pluginOptions, $this->pluginOptions);
        $this->options['uploadType'] = 'imagesUpload';

        if ($this->hasModel()) {
            $this->hiddenInput = Html::activeHiddenInput($this->model, $this->attribute);
        } else {
            $this->hiddenInput = Html::hiddenInput($this->name, $this->value);
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerClientScript();
        $attribute = str_replace("[]", "", $this->attribute);
        $value = trim($this->hasModel() ? Html::getAttributeValue($this->model, $attribute) : $this->value);

        $name = $this->hasModel() ? Html::getInputName($this->model, $this->attribute) : $this->name;
        $config = [
            'boxId' => $this->boxId,
            'name' => $name,
            'filesize' => $this->pluginOptions['uploadMaxSize'],
            'server' => $this->pluginOptions['uploadUrl'],
            'mimeTypes' => $this->options['mimeTypes'],
            'multiple' => $this->options['multiple'],
            'extensions' => $this->options['extensions'],
            'uploadType' => $this->options['uploadType'],
        ];

        return $this->render('image', [
            'name' => $this->hasModel() ? Html::getInputName($this->model, $this->attribute) : $this->name,
            'value' => $this->options['multiple'] == true ? unserialize($value) : $value,
            'options' => $this->options,
            'boxId' => $this->boxId,
            'pluginOptions' => $this->pluginOptions,
            'hiddenInput' => $this->hiddenInput,
            'config' => json_encode($config),
        ]);
    }

    /**
     * 注册资源
     */
    protected function registerClientScript()
    {
        $view = $this->getView();
        WebuploaderAsset::register($view);
        ImageAsset::register($view);
    }
}