<?php
Yii::setAlias('@rootPath', dirname(dirname(__DIR__)));// 根目录
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@attachment', dirname(dirname(__DIR__)) . '/backend/web/attachment');// 附件路径
Yii::setAlias('@attachurl', '/attachment');// 附件二级域名->配置apache