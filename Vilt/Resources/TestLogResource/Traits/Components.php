<?php


namespace Modules\Dusk\Vilt\Resources\TestLogResource\Traits;

use Modules\Base\Services\Components\Base\Component;
use Modules\Dusk\Vilt\Resources\TestLogResource\Actions\ClearLogAction;
use Modules\Dusk\Vilt\Resources\TestLogResource\Actions\RunTestAction;


trait Components
{
    public function components():array
    {
        $components = parent::components();
        return array_merge($components, [
            Component::make(RunTestAction::class)->action(),
            Component::make(ClearLogAction::class)->action(),
        ]);
    }
}
