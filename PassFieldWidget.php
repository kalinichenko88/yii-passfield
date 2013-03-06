<?php
/**
 * Pass*Field is a javascript that simplifies creation of sophisticated password fields.
 * @author Ivan Kalinichenko <joker.bsg@gmail.com>
 * Date: 06.03.13
 * Time: 16:37
 */
class PassFieldWidget extends CInputWidget
{
    /**
     * Package id
     */
    const PACKAGE_ID = 'password-field';

    /**
     * @var string|null Selector pointing to textarea to initialize redactor for.
     * Defaults to null meaning that textarea does not exist yet and will be
     * rendered by this widget.
     */
    public $selector;
    /**
     * @var array
     */
    public $options;

    /**
     * @var array
     */
    public $package = array();

    /**
     * Initalization
     */
    public function init()
    {
        parent::init();

        if ($this->selector === null) {
            list($this->name, $this->id) = $this->resolveNameID();
            $this->htmlOptions['id'] = $this->id;
            $this->selector = "#$this->id";

            if ($this->hasModel()) {
                echo CHtml::passwordField($this->model, $this->attribute, $this->htmlOptions);
            } else {
                echo CHtml::passwordField($this->name, $this->value, $this->htmlOptions);
            }
        }

        $this->package = array(
            'baseUrl' => $this->assetsUrl,
            'js' => array(
                YII_DEBUG ? 'passfield.js' : 'passfield.min.js',
            ),
            'css' => array(
                YII_DEBUG ? 'passfield.css' : 'passfield.min.css',
            ),
            'depends' => array(
                'jquery',
            ),
        );

        $this->registerClientScript();

    }

    /**
     * Register assest files
     */
    public function registerClientScript()
    {
        Yii::app()->clientScript
            ->addPackage(self::PACKAGE_ID, $this->package)
            ->registerPackage(self::PACKAGE_ID)
            ->registerScript(
            $this->id,
            "$('$this->selector').passField(" . CJavaScript::encode($this->options) . ");",
            CClientScript::POS_READY
        );
    }

    /**
     * Get the assets path.
     * @return string
     */
    public function getAssetsPath()
    {
        return dirname(__FILE__) . '/assets';
    }

    /**
     * Publish assets and return url.
     * @return string
     */
    public function getAssetsUrl()
    {
        return Yii::app()->assetManager->publish($this->assetsPath);
    }
}
