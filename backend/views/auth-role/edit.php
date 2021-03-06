<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = $model->isNewRecord ? '创建' : '编辑';
$this->params['breadcrumbs'][] = ['label' => '系统', 'url' => ['/system/index']];
$this->params['breadcrumbs'][] = ['label' => '角色管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'id' => $model->formName(),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::toRoute(['edit','name' => $model['name']]),
]); ?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
    <h4 class="modal-title">基本信息</h4>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="col-sm-12">
                    <?= $form->field($model, 'name',['labelOptions'=>['label'=>'角色名称']])->textInput() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
    <button class="btn btn-primary" type="submit">保存内容</button>
</div>
<?php ActiveForm::end(); ?>
