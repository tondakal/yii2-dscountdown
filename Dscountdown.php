<?php

namespace tondakal\widgets;

use Yii;
//use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\base\InvalidConfigException;

class Dscountdown extends Widget {

    /**
     * @var string
     */
    public $startDate = null;

    /**
     * @var string
     */
    public $endDate;
    
    /**
     * @var array
     */
    public $events = [];
    
    /**
     * @var string
     */
    public $theme = self::THEME_WHITE;

    /**
     * @var array
     */
    public $options = [];

    const THEME_BLACK = 'black';
    const THEME_RED = 'red';
    const THEME_FLAT = 'flat';
    const THEME_NO_THEME = 'custome';
    const THEME_WHITE = 'white';

    const EVENT_BEFORE_START='onBevoreStart';
    const EVENT_CLOCKING='onClocking';
    const EVENT_FINISH='onFinish';
    
    /**
     * @inheritdoc
     */
    public function init() {
        if (empty($this->endDate)) {
            throw new InvalidConfigException('EndDate parameter must be specified');
        }
        $this->initI18N();
        $view = $this->getView();
        DscountdownAsset::register($view);

        $view->registerJs($this->renderScript());

        $this->options['id'] = $this->id;
    }

    /**
     * @inheritdoc
     */
    public function run() {
        $script = '';
        if (Yii::$app->request->isAjax)
            $script = Html::tag('script', $this->renderScript());

        return Html::tag('span', '', $this->options) . $script;
    }

    /**
     * @return string
     */
    protected function renderScript() {

        $script = 'jQuery("#' . $this->id . '").dsCountDown({';
        $script.=
                "titleDays: '" . Yii::t('dscountdown', 'days') . "',
                titleHours: '" . Yii::t('dscountdown', 'hours') . "',
                titleMinutes: '" . Yii::t('dscountdown', 'minutes') . "',
                titleSeconds: '" . Yii::t('dscountdown', 'seconds') . "'";

        $script.= ',endDate:new Date("' . date('F d, Y h:i:s', $this->endDate) . '")';
        
        if ($this->startDate) {
            $script.= ',startDate:new Date("' . date('F d, Y h:i:s', $this->startDate) . '")';
        }
        $script.= ',theme:"'.$this->theme.'"';
        foreach ($this->events as $event => $callback)
            $script .=','.$event . ": function(){{$callback}}";
        $script.= '})';
        
        


        return $script;
    }

    public static function initI18N() {
        $file = 'dscountdown';
        if (!empty(Yii::$app->i18n->translations[$file])) {
            return;
        }
        Yii::setAlias("@{$file}", __DIR__);
        Yii::$app->i18n->translations[$file] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => "@{$file}/messages",
            'forceTranslation' => true
        ];
    }

}
