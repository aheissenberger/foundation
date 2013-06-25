<?php namespace Aheissenberger\Foundation;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class DemoCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'foundation:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy a foundation demo file to /public';

    public function __construct()
    {
        parent::__construct();
    }
   

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $templpath = base_path() . '/vendor/aheissenberger/foundation';
        $is_workbench=!file_exists($templpath);
        if ($is_workbench) {
            $templpath = base_path() . '/workbench/aheissenberger/foundation';
        }
        copy($templpath . '/templates/foundation-demo.html',public_path() . '/foundation-demo.html');
        $this->info('add foundation.html to '.public_path());
    }



}