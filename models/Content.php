<?php namespace LZaplata\Pages\Models;

use Backend\Facades\BackendAuth;
use JanVince\SmallGDPR\Models\CookiesSettings;
use LZaplata\Files\Models\Category as FilesCategory;
use LZaplata\Files\Models\File;
use LZaplata\Gallery\Models\Gallery;
use LZaplata\Pricelists\Models\Pricelist;
use Model;
use October\Rain\Database\Traits\Multisite;
use October\Rain\Database\Traits\Sortable;
use Tailor\Classes\BlueprintIndexer;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Post;
use Tailor\Models\EntryRecord;
use Tailor\Traits\BlueprintRelationModel;

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
        "pricelist" => "required_if:type,pricelist",
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
            "text"  => "Text",
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

        if (BlueprintIndexer::instance()->findSectionByHandle("FAQ\Question")) {
            $types["faq"] = "FAQ";
        }

        if (BlueprintIndexer::instance()->findSectionByHandle("Contacts\Contact")) {
            $types["contacts"] = e(trans("lzaplata.pages::lang.content.field.type.option.contacts.label"));
        }

        if (class_exists(CookiesSettings::class)) {
            $types["cookies"] = e(trans("lzaplata.pages::lang.content.field.type.option.cookies.label"));
        }

        return $types;
    }

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
