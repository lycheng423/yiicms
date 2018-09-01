<?php
namespace backend\controllers;

use backend\models\ActionLog;
use yii\data\Pagination;

/**
 * 系统日志控制器控制器
 *
 * Class ActionLogController
 */
class ActionLogController extends MController
{
    /**
     * 首页
     */
    public function actionIndex()
    {
        $data = ActionLog::find()->with('manager');
        $pages = new Pagination(['totalCount' => $data->count(), 'pageSize' => $this->_pageSize]);
        $models = $data->offset($pages->offset)
            ->orderBy('id desc')
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }

    /**
     * 返回模型
     *
     * @param $id
     * @return ActionLog|static
     */
    protected function findModel($id)
    {
        if (empty($id)) {
            $model = new ActionLog;
            return $model->loadDefaultValues();
        }

        if (empty(($model = ActionLog::findOne($id)))) {
            return new ActionLog;
        }

        return $model;
    }
}