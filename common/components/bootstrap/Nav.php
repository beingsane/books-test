<?php

namespace common\components\bootstrap;

use Yii;
use yii\bootstrap\Nav as YiiBootstrapNav;

/**
 * Adds additional checks for isItemActive() function
 * @inheritdoc
 */
class Nav extends YiiBootstrapNav
{
    /**
     * Adds additional checks
     * @inheritdoc
     */
    protected function isItemActive($item)
    {
        if (parent::isItemActive($item)) {
            return true;
        }

        if (!isset($item['url'])) {
            return false;
        }

        $route = null;
        $itemUrl = $item['url'];
        $requestUrl = Yii::$app->request->getUrl();

        if (is_array($itemUrl) && isset($itemUrl[0])) {
            $route = $itemUrl[0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
        } else {
            $route = $itemUrl;
        }

        $isActive = ($route === $requestUrl);
        return $isActive;
    }
}
