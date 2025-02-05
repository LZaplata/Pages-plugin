<?php namespace LZaplata\Pages\Models;

use Backend\Facades\BackendAuth;
use Cms\Classes\Partial;
use Cms\Classes\Theme;
use Model;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Post;
use System\Models\File;
use Tailor\Classes\BlueprintIndexer;
use Tailor\Models\EntryRecord;
use Tailor\Traits\BlueprintRelationModel;

/**
 * Model
 */
class Block extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;
    use BlueprintRelationModel;

    /**
     * @var array dates to cast from the database.
     */
    protected $dates = ['deleted_at'];

    /**
     * @var string table in the database used by the model.
     */
    public $table = 'lzaplata_pages_blocks';

    /**
     * @var array rules for validation.
     */
    public $rules = [
        "title"         => "required",
        "type"          => "required",
        "sort_order"    => ["required", "numeric"],
    ];

    /**
     * @var array
     */
    public $attachOne = [
        "image" => File::class,
    ];

    /**
     * @var array
     */
    public $belongsTo = [
        "blog_category" => Category::class,
        "slider"        => [EntryRecord::class, "blueprint" => "lzaplata_slider_sliders"],
    ];

    /**
     * @return array
     */
    public function getTypeOptions(): array
    {
        $types = [
            "text"          => "Text",
            "image_text"    => e(trans("lzaplata.pages::lang.block.field.type.option.image_text.label")),
            "partial"       => e(trans("lzaplata.pages::lang.block.field.type.option.partial.label")),
            "embed"         => e(trans("lzaplata.pages::lang.block.field.type.option.embed.label")),
        ];

        if (BlueprintIndexer::instance()->findSectionByHandle("Slider\Slide")) {
            $types["slider"] = "Slider";
        }

        if (class_exists(Post::class)) {
            $types["posts"]         = e(trans("lzaplata.pages::lang.block.field.type.option.posts.label"));
            $types["posts_slider"]  = e(trans("lzaplata.pages::lang.block.field.type.option.posts_slider.label"));
            $types["flash_message"] = e(trans("lzaplata.pages::lang.block.field.type.option.flash_message.label"));
        }

        return $types;
    }

    /**
     * @param string|null $value
     * @param Block $formData
     * @return array
     * @throws \ApplicationException
     */
    public function getPartialOptions(?string $value, Block $formData): array
    {
        $theme = Theme::getActiveTheme();
        $partials = Partial::listInTheme($theme);
        $partialOptions = [];

        foreach ($partials as $partial) {
            if ($this->type == "posts" && preg_match("@_post/[a-z]+@", $partial->getBaseFileName())) {
                $partialOptions[$partial->getBaseFileName()] = $partial->getBaseFileName();
            }

            if ($this->type == "partial") {
                $partialOptions[$partial->getBaseFileName()] = $partial->getBaseFileName();
            }
        }

        asort($partialOptions);

        return $partialOptions;
    }

    /**
     * @return array
     */
    public function getNoGuttersBreakpointOptions(): array
    {
        return [
            "xs"    => "XS",
            "sm"    => "SM",
            "md"    => "MD",
            "lg"    => "LG",
            "xl"    => "XL",
            "xxl"   => "XXL",
        ];
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
     * @param $fields
     * @param $context
     *
     * @return void
     */
    public function filterFields($fields, $context = null)
    {
        if (BackendAuth::userHasPermission("lzaplata.pages.block.reorder")) {
            $latestSibling = Block::orderBy("sort_order", "desc")
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
