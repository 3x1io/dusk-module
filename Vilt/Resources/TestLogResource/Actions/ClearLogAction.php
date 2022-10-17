<?php


namespace Modules\Dusk\Vilt\Resources\TestLogResource\Actions;

use Modules\Base\Services\Components\Actions;

class ClearLogAction extends Actions
{
    public function setup(): void
    {
        $this->name("clear");
        $this->label(__('Clear Log'));
        $this->type("success");
        $this->icon("");
        $this->modal(null);
        $this->action('tests.clear');
        $this->url(null);
        $this->can(true);
    }
}

