<?php

namespace Modules\Dusk\Services\Components;


use Modules\Base\Services\Concerns\HasType;
use Modules\Base\Services\Core\Abstracts\HasMake;
use Modules\Dusk\Entities\TestLog;

class Log extends HasMake
{
    use HasType;

    public function save(): void
    {
        $newLog = new TestLog();
        $newLog->log = $this->name;
        $newLog->type = $this->type ?: 'success';
        $newLog->save();
    }
}
