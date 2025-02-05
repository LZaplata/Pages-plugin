<?php namespace LZaplata\Pages\Models;

use Backend\Facades\BackendAuth;
use Cms\Classes\Partial;
use Cms\Classes\Theme;
use JanVince\SmallGDPR\Models\CookiesSettings;
use LZaplata\Files\Models\Category as FilesCategory;
use LZaplata\Files\Models\File;
use LZaplata\Gallery\Models\Gallery;
use LZaplata\OpeningHours\Models\OpeningHour;
use LZaplata\Pricelists\Models\Pricelist;
use Model;
use October\Rain\Database\Traits\Multisite;
use October\Rain\Database\Traits\Sortable;
use Tailor\Classes\BlueprintIndexer;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Post;
use Tailor\Models\EntryRecord;
use Tailor\Traits\BlueprintRelationModel;
use System\Models\File as SystemFile;

/**
 * Model
 */
class Content extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;
    use Multisite;
    use BlueprintRelationModel;
    use Sortable;

    /**
     * @var array dates to cast from the database.
     */
    protected $dates = ['deleted_at'];

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'lzaplata_pages_contents';

    /**
     * @var array rules for validation.
     */
    public $rules = [
        "pricelist"     => "required_if:type,pricelist",
        "opening_hours" => "required_if:type,opening_hours",
    ];

    /**
     * @var array
     */
    public $propagatable = [];

    /**
     * @return array
     */
    public function getTypeOptions()
    {
        $types = [
            "text"          => "Text",
            "image_text"    => e(trans("lzaplata.pages::lang.content.field.type.option.image_text.label")),
            "embed"         => e(trans("lzaplata.pages::lang.content.field.type.option.embed.label")),
        ];

        if (class_exists(Post::class)) {
            $types["blog"] = e(trans("lzaplata.pages::lang.content.field.type.option.blog.label"));
        }

        if (class_exists(Gallery::class)) {
            $types["gallery"] = e(trans("lzaplata.pages::lang.content.field.type.option.gallery.label"));
        }

        if (class_exists(File::class)) {
            $types["files"] = e(trans("lzaplata.pages::lang.content.field.type.option.files.label"));
        }

        if (class_exists(Pricelist::class)) {
            $types["pricelist"] = e(trans("lzaplata.pages::lang.content.field.type.option.pricelist.label"));
        }

        if (class_exists(OpeningHour::class)) {
            $types["opening_hours"] = e(trans("lzaplata.pages::lang.content.field.type.option.opening_hours.label"));
        }

        if (BlueprintIndexer::instance()->findSectionByHandle("FAQ\Question")) {
            $types["faq"] = "FAQ";
        }

        if (BlueprintIndexer::instance()->findSectionByHandle("Contacts\Contact")) {
            $types["contacts"] = e(trans("lzaplata.pages::lang.content.field.type.option.contacts.label"));
        }

        if (BlueprintIndexer::instance()->findSectionByHandle("Slider\Slider")) {
            $types["slider"] = e(trans("lzaplata.pages::lang.content.field.type.option.slider.label"));
        }

        if (class_exists(CookiesSettings::class)) {
            $types["cookies"] = e(trans("lzaplata.pages::lang.content.field.type.option.cookies.label"));
        }

        return $types;
    }

    /**
     * @param string|null $value
     * @param Content $formData
     * @return array
     * @throws \ApplicationException
     */
    public function getPartialOptions(?string $value, Content $formData): array
    {
        $theme = Theme::getActiveTheme();
        $partials = Partial::listInTheme($theme);
        $partialOptions = [];

        foreach ($partials as $partial) {
            if ($this->type == "contacts" && preg_match("@_contact/[a-z]+@", $partial->getBaseFileName())) {
                $partialOptions[$partial->getBaseFileName()] = $partial->getBaseFileName();
            }

            if ($this->type == "blog" && preg_match("@_post/[a-z]+@", $partial->getBaseFileName())) {
                $partialOptions[$partial->getBaseFileName()] = $partial->getBaseFileName();
            }
        }

        asort($partialOptions);

        return $partialOptions;
    }

    /**
     * @return array
     */
    public function getRowColsOptions(): array
    {
        return [
            "1"     => "1",
            "2"     => "2",
            "3"     => "3",
            "4"     => "4",
            "5"     => "5",
            "6"     => "6",
        ];
    }

    /**
     * @var array
     */
    public $attachOne = [
        "image" => SystemFile::class,
    ];

    /**
     * @var array
     */
    public $belongsTo = [
        "gallery"           => Gallery::class,
        "contacts_category" => [EntryRecord::class, "blueprint" => "lzaplata_contacts_categories"],
        "blog_category"     => Category::class,
        "files_category"    => FilesCategory::class,
        "page"              => Page::class,
        "pricelist"         => Pricelist::class,
        "opening_hours"     => OpeningHour::class,
        "slider"            => [EntryRecord::class, "blueprint" => "lzaplata_slider_sliders"],
    ];

    /**
     * @param $fields
     * @param $context
     *
     * @return void
     */
    public function filterFields($fields, $context = null)
    {
        if (!BackendAuth::userHasPermission("lzaplata.pages.content.update.type")) {
            $fields->type->disabled = true;
        }

        if (BackendAuth::userHasPermission("lzaplata.pages.content.reorder")) {
            $latestSibling = Content::where("page_id", $this->page->id)
                ->orderBy("sort_order", "desc")
                ->first();

            if ($latestSibling) {
                $order = $fields->sort_order->value ?: $latestSibling->sort_order + 10;
            } else {
                $order = 10;
            }

            $fields->sort_order->value = $order;
        }
    }
}
