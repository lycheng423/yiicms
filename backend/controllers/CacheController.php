<?php
namespace backend\controllers;

use yii;
use yii\caching\FileCache;

/**
 * 缓存清理控制器
 *
 * Class CacheController
 * @package backend\controllers
 */
class CacheController extends MController
{
    /**
     * 缓存清理控制器
     *
     * @return string
     */
    public function actionClear()
    {
        // 删除后台文件缓存
        Yii::$app->cache->flush();

        return $this->render('clear',[
        ]);
    }
}