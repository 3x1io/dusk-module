<?php


namespace Modules\Dusk\Services\ComponentGenerator;


use Illuminate\Support\Str;
use Modules\Generator\Interfaces\GeneratorInterface;
use Modules\Generator\Services\Helpers\CanManipulateFiles;

class TestGenerator implements GeneratorInterface
{
    use CanManipulateFiles;


    private string $actionLabel;
    private string $modelName;
    private array $folderDirectory;
    private string $targetPath;
    /**
     * ModelGenerator constructor.
     * @param string $actionName
     * @param string $moduleName
     */
    public function __construct(
        public string $actionName,
        public string $moduleName,
    ) {
        $this->generateModelName();
    }

    public function generateModelName()
    {
        $this->modelName = ucfirst(Str::camel($this->actionName));
        $this->targetPath = module_path($this->moduleName) . "/Tests/{$this->modelName}";
        $this->folderDirectory = ["/Resources/view/{$this->modelName}"];
        $this->actionLabel = trim(ucwords(implode(' ', preg_split('/(?=[A-Z])/', $this->modelName))));
    }

    public function generate()
    {
        $this->checkForCollision();

        $this->copyStubToApp('Test', module_path($this->moduleName) . "/Tests/" . $this->modelName . "Test.php", [
            "tableName" => $this->actionName,
            "titleLabel" => Str::ucfirst(Str::singular($this->modelName)),
            "modelName" => $this->modelName,
            "moduleName" => $this->moduleName,
        ], module_path('DuskTest') . '/stubs/');
    }
}
