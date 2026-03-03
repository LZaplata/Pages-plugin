<?php namespace Lzaplata\Pages\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Cms\Classes\Theme;
use Cms\Models\ThemeData;

/**
 * BlockTypeSelector Form Widget
 *
 * @link https://docs.octobercms.com/3.x/extend/forms/form-widgets.html
 */
class ColorSchemeSelector extends FormWidgetBase
{
    /**
     * @var string
     */
    protected $defaultAlias = "colorschemeselector";

    public function init()
    {
    }

    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('colorschemeselector');
    }

    /**
     * @return void
     * @throws \ApplicationException
     */
    public function prepareVars(): void
    {
        $theme = Theme::getActiveTheme();
        $themeData = ThemeData::forTheme($theme);

        $this->vars["model"] = $this->model;
        $this->vars["name"] = $this->formField->getName();
        $this->vars["value"] = $this->getLoadValue();
        $this->vars["id"] = $this->formField->getId();
        $this->vars["options"] = $themeData["schemes"] ?? [];
    }

    public function loadAssets()
    {
        $this->addCss('css/colorschemeselector.css');
        $this->addJs('js/colorschemeselector.js');
    }

    public function getSaveValue($value)
    {
        return $value;
    }
}
