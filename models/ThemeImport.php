<?php

namespace LZaplata\Pages\Models;

use Backend\Models\ImportModel;
use Cms\Classes\Theme;
use Cms\Models\ThemeData;

class ThemeImport extends ImportModel
{
    /**
     * @var array
     */
    public array $rules = [];

    /**
     * @param $results
     * @param $sessionKey
     * @return void
     */
    public function importData($results, $sessionKey = null): void
    {
        foreach ($results as $row => $data) {
            try {
                $theme = Theme::load($data["code"]);
                $themeData = ThemeData::forTheme($theme);

                foreach ($data as $key => $value) {
                    if ($key == "code") continue;

                    $themeData->{$key} = $value;
                }

                $themeData->save();

                $this->logUpdated();
            } catch (\Exception $exception) {
                $this->logError($row, $exception->getMessage());
            }
        }
    }
}
