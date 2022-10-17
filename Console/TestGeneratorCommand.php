<?php

namespace Modules\Dusk\Console;

use Illuminate\Console\Command;
use Modules\Generator\Console\Helpers\ModuleHandler;
use Modules\Dusk\Services\ComponentGenerator\TestGenerator;

class TestGeneratorCommand extends Command
{
    use ModuleHandler;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'vilt:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make dusk test file inside Tests folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $actionName = $this->ask('Please input your test name? (ex: UserLogin)');
        $moduleName = $this->ask('Please input your module name? (ex: Blog)');

        // create module if not exists
        $this->createModule($moduleName);


        $modelGenerator = new TestGenerator(actionName: $actionName, moduleName: $moduleName);
        $modelGenerator->generate();
        $this->info('The Tests Has Been Generated :)');
    }
}
