<?php namespace Lzaplata\Pages\Components;

use Cms\Classes\ComponentBase;
use LZaplata\Pages\Models\Page as PageModel;
use October\Rain\Support\Facades\Event;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Page Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class Page extends ComponentBase
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var array
     */
    public $contents;

    /**
     * @var string
     */
    public $menu;

    /**
     * @var string
     */
    public $metaTitle;

    /**
     * @var string
     */
    public $metaDescription;

    public function componentDetails()
    {
        return [
            "name" => "lzaplata.pages::lang.component.page.name",
            "description" => "lzaplata.pages::lang.component.page.description",
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [
            "column" => [
                "title" => "lzaplata.pages::lang.component.page.column.title",
                "description" => "lzaplata.pages::lang.component.page.column.description",
                "type" => "dropdown",
                "options" => [
                    "slug"      => "Slug",
                    "fullslug"  => "Full Slug",
                ],
                "default" => "slug",
            ],
            "value" => [
                "title"         => "lzaplata.pages::lang.component.page.value.title",
                "description"   => "lzaplata.pages::lang.component.page.value.description",
                "type"          => "string",
                "default"       => "{{ :slug }}",
            ],
        ];
    }

    public function onRun()
    {
        $page = PageModel::where($this->property("column"), $this->property("value"))->first();

        if (!$page) {
            throw new NotFoundHttpException();
        }

        $otherPages = $page->newOtherSiteQuery()->get();

        // Translating URL parameters
        Event::listen("cms.sitePicker.overrideParams", function($page, $params, $currentSite, $proposedSite) use ($otherPages): array {
            $otherPage = $otherPages->where("site_id", $proposedSite->id)->first();

            if ($otherPage) {
                $params["id"] = $otherPage->id;
                $params["slug"] = $otherPage->slug;
                $params["fullslug"] = $otherPage->fullslug;
            }

            return $params;
        });

        if ($page) {
            $this->id = $page->slug;
            $this->title = $page->title;
            $this->slug = $page->slug;
            $this->contents = $page->contents->where("is_published", true)->sortBy("sort_order");
            $this->menu = $page->menu;
            $this->metaTitle = $page->meta_title;
            $this->metaDescription = $page->meta_description;
        }
    }
}
