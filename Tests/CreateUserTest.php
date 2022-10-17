<?php

namespace Modules\Dusk\Tests;

use Modules\Base\Services\Core\Abstracts\HasMake;
use Modules\Dusk\Services\Components\Log;
use Modules\Dusk\Services\Core\Browser;
use Modules\Dusk\Services\Core\Chrome;

class CreateUserTest extends HasMake
{
    private Chrome $dusk;

    public function __construct()
    {
        $this->dusk = Browser::make('web')->run();
    }

    public function run():void
    {
        try {
            $this->dusk->browse(function ($browser) {
                //Login :)
                $browser->visit(url('login'));
                $browser->pause(2000);
                $browser->type('#email','admin@admin.com');
                $browser->pause(2000);
                $browser->type('#password','QTS@2022');
                $browser->pause(2000);
                $browser->click('#app > div > div > div > div > div:nth-child(3) > form > button');
                $browser->pause(2000);
                Log::make("Login Success and pass")->save();

                $browser->pause(2000);
                $browser->click('#app > div > div > aside > nav > div > div:nth-child(7) > div:nth-child(2) > ul > li:nth-child(2) > a');
                $browser->pause(2000);
                $browser->click('#app > div > div > div.lg\:pl-80.lg\:pl-80.rtl\:lg\:pr-80.rtl\:lg\:pl-0.flex.filament-main.flex-col.gap-y-6.w-screen.flex-1.hidden.h-full.transition-all.filament-main-sidebar-open > div.filament-main-content.flex-1.w-full.px-4.mx-auto.md\:px-6.lg\:px-8.max-w-7xl > div > div.filament-page.filament-resources-list-records-page.filament-resources-users > header > div > a');
                $browser->pause(2000);
                $browser->type('#name','Test User');
                $browser->pause(2000);
                $browser->type('#email','Test User');
                $browser->pause(2000);
                $browser->type('#password','Test User');
                $browser->pause(2000);
                $browser->type('#password_confirmation','Test User');
                $browser->pause(2000);
                $browser->click('body > div:nth-child(8) > div.transition-all.transform.filament-modal-window.p-2.bg-white.cursor-default.pointer-events-auto.dark\:bg-gray-800.relative.rounded-xl.mx-auto.sm\:max-w-2xl.w-full > div.filament-modal-content.space-y-2.py-4.px-4 > div > form > div:nth-child(5) > div > div.multiselect--above.multiselect.mt-2 > div.multiselect__tags');
                $browser->pause(2000);
                $browser->click('#null-0 > span > div');
                $browser->pause(2000);
                $browser->click('body > div:nth-child(8) > div.transition-all.transform.filament-modal-window.p-2.bg-white.cursor-default.pointer-events-auto.dark\:bg-gray-800.relative.rounded-xl.mx-auto.sm\:max-w-2xl.w-full > div.filament-modal-footer.px-4.py-4 > div > button.filament-button.inline-flex.items-center.justify-center.py-1.gap-1.font-medium.rounded-lg.border.transition-colors.focus\:outline-none.focus\:ring-offset-2.focus\:ring-2.focus\:ring-inset.dark\:focus\:ring-offset-0.min-h-\[2\.25rem\].px-4.text-sm.text-white.shadow.focus\:ring-white.border-transparent.bg-primary-600.hover\:bg-primary-500.focus\:bg-primary-700.focus\:ring-offset-primary-700.filament-page-modal-button-action');
            });

        }catch (\Exception $e){
            if(!strpos($e, 'file_put_contents')){
                Log::make("Login Failed Error: " . $e)->type('danger')->save();
            }
        }

        $this->dusk->stop();
    }
}
