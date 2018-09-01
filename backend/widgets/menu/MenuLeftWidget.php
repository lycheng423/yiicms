<?php
namespace backend\widgets\menu;

use yii\base\Widget;
use backend\enums\StatusEnum;
use backend\models\Menu;

/**
 * Class MainLeftWidget
 * @package backend\widgets\left
 */
class MenuLeftWidget extends Widget
{
    public function run()
    {
        return $this->render('menu-left', [
            'models' => Menu::getMenus(Menu::TYPE_MENU, StatusEnum::ENABLED),
        ]);
    }
}