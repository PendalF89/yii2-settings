<?php

namespace pendalf89\settings;

use Yii;
use pendalf89\settings\models\Settings;

class Setting extends \yii\base\Component
{
    private $settings = [];

    public function init()
    {
        parent::init();
        $this->loadSettings();
    }

    private function loadSettings()
    {
        $settings = Settings::find()->all();

        foreach ($settings as $setting) {
            $this->settings[$setting->key] = $setting->value;
        }
    }

    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->settings) ? $this->settings[$key] : $default;
    }

    public function set($key, $value)
    {
        if (!$model = Settings::findOne($key)) {
            $model = new Settings();
        }

        $this->settings[$key] = $value;

        if ($model->isNewRecord) {
            $model->key = $key;
        }

        $model->value = $value;
        $model->save();
    }
}
