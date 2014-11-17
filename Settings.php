<?php

namespace pendalf89\settings;

use Yii;
use yii\db\Query;

/**
 * This is Settings component for storage settings in DB.
 *
 * Example of usage:
 *
 * $settings = Yii::$app->settings;
 * $settings->set('sitemap.update_cache_freq', 21600);
 * echo $settings->get('sitemap.update_cache_freq');
 * // 21600
 *
 * @package pendalf89\settings
 */
class Settings extends \yii\base\Component
{
    /**
     * @var array settings
     */
    private $settings = [];

    /**
     * Initial component
     */
    public function init()
    {
        parent::init();
        $this->loadSettings();
    }

    /**
     * Get setting by $key
     *
     * @param $key
     * @param mixed $default
     * @return mixed setting
     */
    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->settings) ? $this->settings[$key] : $default;
    }

    /**
     * Set setting
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $connection = Yii::$app->db;

        if (isset($this->settings[$key])) {
            $connection->createCommand()->update('settings', ['value' => $value])->execute();
        } else {
            $connection->createCommand()->insert('settings', [
                'key' => $key,
                'value' => $value,
            ])->execute();
        }

        $this->settings[$key] = $value;
    }

    /**
     * Remove setting from settings by $key
     *
     * @param $key
     * @return bool|int
     */
    public function remove($key)
    {
        $connection = Yii::$app->db;

        if (isset($this->settings[$key])) {
            unset($this->settings[$key]);
            return $connection->createCommand()->delete('settings', ['key' => $key])->execute();
        } else {
            return false;
        }
    }

    /**
     * Load settings
     */
    private function loadSettings()
    {
        $settings = (new Query())
            ->select('*')
            ->from('settings')
            ->all();

        foreach ($settings as $setting) {
            $this->settings[$setting['key']] = $setting['value'];
        }
    }
}
