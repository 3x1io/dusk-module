<?php


namespace Modules\Dusk\Vilt\Resources\TestLogResource\Actions;

use Modules\Base\Services\Components\Actions;

class RunTestAction extends Actions
{
    public function setup(): void
    {
        $this->name("run");
        $this->label(__('Run Test'));
        $this->type("success");
        $this->icon("bx bxs-check");
        $this->modal(null);
        $this->action('tests.start');
        $this->url(null);
        $this->can(true);
    }
}

