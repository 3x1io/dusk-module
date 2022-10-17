<?php


namespace Modules\Dusk\Vilt\Resources\TestLogResource\Traits;

trait Translations
{
    public function loadTranslations(): array
    {
        return [
            "index" => __(" Test Logs"),
            "create" => __('Create ' . " Test Log"),
            "bulk" => __('Delete Selected ' . " Test Log"),
            "edit_title" => __('Edit ' . " Test Log"),
            "create_title" => __('Create New ' . " Test Log"),
            "view_title" => __('View ' . " Test Log"),
            "delete_title" => __('Delete ' . " Test Log"),
            "bulk_title" => __('Run Bulk Action To ' . " Test Log"),
        ];
    }
}
