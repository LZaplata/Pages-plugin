<?php namespace LZaplata\Pages\Controllers;

use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Behaviors\RelationController;
use Backend\Facades\BackendAuth;
use BackendMenu;
use Backend\Classes\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response as HttpResponse;
use LZaplata\Pages\Models\Page;

class Pages extends Controller
{
    public $implement = [
        FormController::class,
        ListController::class,
        RelationController::class,
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = [
        "lzaplata.pages.page",
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('LZaplata.Pages', 'main-menu-item', 'side-menu-item');
    }

    /**
     * @param $config
     * @param $field
     * @param $model
     *
     * @return void
     */
    public function relationExtendConfig($config, $field, $model)
    {
        // Make sure the model and field matches those you want to manipulate
        if (!$model instanceof Page || $field !== "contents") {
            return;
        }

        $buttons = [];

        if (BackendAuth::userHasPermission("lzaplata.pages.content.create")) {
            $buttons[] = "create";
        }

        if (BackendAuth::userHasPermission("lzaplata.pages.content.delete")) {
            $buttons[] = "delete";
        }

        $config->view["toolbarButtons"] = empty($buttons) ? false : implode("|", $buttons);
    }

    /**
     * @param int $id
     * @return HttpResponse|null
     */
    public function update(int $id): ?HttpResponse
    {
        $page = Page::find($id);

        if ($page) {
            $permissionName = str_replace("/", ".", $page->fullslug);

            if (BackendAuth::userHasAccess("lzaplata.pages.structure") && !BackendAuth::userHasAccess("lzaplata.pages.structure.$permissionName")) {
                $content = View::make("backend::access_denied")->render();

                return Response::make($content, 403);
            }
        }

        return parent::update($id);
    }
}
