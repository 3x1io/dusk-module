<?php


namespace Modules\Dusk\Vilt\Resources;

use Modules\Dusk\Entities\TestLog;
use Modules\Base\Services\Resource\Resource;
use Modules\Dusk\Vilt\Resources\TestLogResource\Traits\Translations;
use Modules\Dusk\Vilt\Resources\TestLogResource\Traits\Components;

use Modules\Base\Services\Rows\Text;
use Modules\Base\Services\Rows\Rich;


class TestLogResource extends Resource
{
    use Translations, Components;

    public ?string $model = TestLog::class;
    public ?string $icon = "bx bx-test-tube";
    public ?string $group = "Tools";
    public ?bool $api = true;

    public function rows(): array
    {
        $this->canCreate = false;
        $this->canEdit = false;

        return [
            Text::make('id')
                ->label(__('id'))
                ->create(false)
                ->edit(false),

            Rich::make('log')
                ->label(__('log'))
                ->validation([
                    "create" => "required|string",
                    "update" => "required|string"
                ]),

            Text::make('type')
                ->badge()
                ->color('success')
                ->label(__('type'))
                ->validation([
                    "create" => "nullable|string|max:255",
                    "update" => "nullable|string|max:255"
                ])
                ->default("info"),
        ];
    }
}
