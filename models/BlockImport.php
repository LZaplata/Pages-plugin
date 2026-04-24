<?php

namespace LZaplata\Pages\Models;

use Backend\Models\ImportModel;

class BlockImport extends ImportModel
{
    /**
     * @var array
     */
    public array $rules = [];

    /**
     * @param  $results
     * @param  $sessionKey
     * @return void
     */
    public function importData($results, $sessionKey = null): void
    {
        foreach ($results as $row => $data) {
            try {
                $block = new Block();

                foreach ($data as $column => $value) {
                    $block->{$column} = $value;
                }

                $block->save();

                $this->logCreated();
            } catch (\Exception $exception) {
                $this->logError($row, $exception->getMessage());
            }
        }
    }
}