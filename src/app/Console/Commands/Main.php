<?php

namespace CIH\Core\App\Console\Commands;

use CIH\Core\App\Repo\ModuleMaker;
use Illuminate\Console\Command;

class Main extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cih {module} {action} {itemName?} {--table=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CIH Main commands file';

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
     * @return int
     */
    public function handle()
    {
        $module = $this->argument('module');
        $action = $this->argument('action');
        $itemName = $this->argument('itemName');
        $options = $this->option();
        
        $actions = ['make:controller', 'make:model', 'make:migration', 'make:route'];
        if (in_array($action, $actions)) {
            $action = explode('make:', $action, 2)[1];
            if ($itemName) {
                $module = new ModuleMaker($module);
                $this->info($module->make($action, $itemName, $options));
            } else {
                $this->error('Please specify the ' . $action . ' name');
            }
        }else if ($action === 'init') {
            $module = new ModuleMaker($module);
            $this->info($module->make());
        }
        // if ($this->argument('-extra')) {
        //     //do things if -extra action exists, it will be an array with the extra actions value...
        // }

    }
}
