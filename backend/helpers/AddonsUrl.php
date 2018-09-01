<?php
namespace backend\helpers;

use yii\helpers\Url;

/**
 * 插件Url生成辅助类
 *
 * Class AddonsUrl
 * @package backend\helpers
 */
class AddonsUrl
{
    /**
     * 生成模块Url
     *
     * @param array $url
     * @param bool $scheme
     * @return bool|string
     */
    public static function to(array $url, $scheme = false)
    {
        return urldecode(Url::to(AddonsHelp::regroupUrl($url),$scheme));
    }

    /**
     * 通过绝对路径生成模块Url
     *
     * @return string
     */
    public static function toAbsoluteUrl(array $url, $scheme = false)
    {
        return urldecode(Yii::$app->urlManager->createUrl(AddonsHelp::regroupUrl($url),$scheme));
    }

    /**
     * 生成插件基类跳转链接
     *
     * @return string
     */
    public static function toRoot(array $url, $scheme = false)
    {
        return urldecode(Url::to(AddonsHelp::regroupUrl($url,true),$scheme));
    }
}
