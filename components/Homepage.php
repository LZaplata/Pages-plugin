<?php namespace Lzaplata\Pages\Components;

use Cms\Classes\ComponentBase;
use LZaplata\Pages\Models\Block;

/**
 * Page Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Homepage extends ComponentBase
{
    /**
     * @var array
     */
    public $blocks;

    public function componentDetails()
    {
        return [
            "name" => "lzaplata.pages::lang.component.homepage.name",
            "description" => "lzaplata.pages::lang.component.homepage.description",
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $this->blocks = Block::all()
            ->where("is_published", true)
            ->sortBy("sort_order");
    }
}
