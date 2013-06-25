<?php namespace Aheissenberger\Foundation;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class SetupCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'foundation:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a basic setup in /app directory';

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
        if (!file_exists(app_path() . '/scss')) {
            mkdir(app_path() . '/scss');
            $this->info('created directory: /app/scss');
        }
        $templpath = base_path() . '/vendor/aheissenberger/foundation';
        $is_workbench=!file_exists($templpath);

        $cfgreplace = true;
        if (file_exists(app_path() . '/scss'.'/app.scss')) {
            $cfgreplace = $this->confirm('Do you want to replace /app/config.rb [y/n]? ', false);
        }
        if ($cfgreplace) {
            if ($is_workbench) {
                $templpath = base_path() . '/workbench/aheissenberger/foundation';
            }
            $templpath .= '/templates';
            copy($templpath . '/config.rb',app_path() . '/scss'.'/config.rb');
            $this->info('copy config.rb to /app/scss');
        }

        $appreplace = true;
        if (file_exists(app_path() . '/scss'.'/app.scss')) {
            $appreplace = $this->confirm('Do you want to replace /app/scss/app.css [y/n]? ', false);
        }
        if ($appreplace) {
            if (!$is_workbench) {
                copy($templpath . '/app.scss',app_path() . '/scss'.'/app.scss');
            } else {
                file_put_contents(app_path() . '/scss'.'/app.scss', str_replace('vendor','workbench',file_get_contents($templpath . '/app.scss')));
            }
            $this->info('copy app.scss to /app/scss');
        }

        if (!file_exists(public_path() . '/css')) {
            mkdir(public_path() . '/css');
            $this->info('created directory: /public/css');
        }

        if (!file_exists(public_path() . '/img')) {
            mkdir(public_path() . '/img');
            $this->info('created directory: /public/img');
        }
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function demo()
    {
        $templpath = base_path() . '/vendor/aheissenberger/foundation';
        $is_workbench=!file_exists($templpath);
        copy($templpath . '/foundation-demo.html',public_path() . '/foundation-demo.html');
        
    }


    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('collection', InputArgument::OPTIONAL, 'Collection whose assets will be published'),
        );
    }

}