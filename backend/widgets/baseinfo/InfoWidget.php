<?php
/**
 * 一些站点统计widget
 */
namespace backend\widgets\baseinfo;

use yii\base\Widget;
use backend\models\Manager;

class InfoWidget extends Widget
{
    public function run()
    {
        return $this->render('index', [
            'managerCount'      => Manager::find()->count(),
            'managerVisitor'    => Manager::find()->sum('visit_count'),
        ]);
    }
}

?>