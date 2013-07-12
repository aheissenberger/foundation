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
        if (!file_exists(app_path() . '/assets')) {
            mkdir(app_path() . '/assets');
            $this->info('created directory: '.app_path().'/assets');
        }
        if (!file_exists(app_path() . '/assets/sass')) {
            mkdir(app_path() . '/assets/sass');
            $this->info('created directory: '.app_path().'/assets/sass');
        }
        if (!file_exists(app_path() . '/assets/sprites')) {
            mkdir(app_path() . '/assets/sprites');
            $this->info('created directory: '.app_path().'/assets/sprites');
        }
        if (!file_exists(app_path() . '/assets/img')) {
            mkdir(app_path() . '/assets/img');
            $this->info('created directory: '.app_path().'/assets/img');
        }
        if (!file_exists(app_path() . '/assets/js')) {
            mkdir(app_path() . '/assets/js');
            $this->info('created directory: '.app_path().'/assets/js');
        }
        $templpath = base_path() . '/vendor/aheissenberger/foundation';
        $is_workbench=!file_exists($templpath);
        if ($is_workbench) {
            $templpath = base_path() . '/workbench/aheissenberger/foundation';
        }
        $cfgreplace = true;
        if (file_exists(app_path() . '/assets/sass'.'/app.scss')) {
            $cfgreplace = $this->confirm('Do you want to replace '.app_path().'/config.rb [y/n]? ', false);
        }
        if ($cfgreplace) {

            copy($templpath . '/templates/config.rb',app_path() . '/assets/sass'.'/config.rb');
            $this->info('copy config.rb to '.app_path().'/assets/sass');
        }

        $appreplace = true;
        if (file_exists(app_path() . '/assets/sass'.'/app.scss')) {
            $appreplace = $this->confirm('Do you want to replace '.app_path().'/assets/sass/app.scss [y/n]? ', false);
        }
        if ($appreplace) {
            if (!$is_workbench) {
                copy($templpath . '/templates/app.scss',app_path() . '/assets/sass'.'/app.scss');
            } else {
                file_put_contents(app_path() . '/assets/sass'.'/app.scss', str_replace('vendor','workbench',file_get_contents($templpath . '/templates/app.scss')));
            }
            $this->info('copy app.scss to '.app_path().'/assets/sass');
        }
/*
        $appreplace = true;
        if (file_exists(app_path() . '/assets/sass'.'/normalize.scss')) {
            $appreplace = $this->confirm('Do you want to replace '.app_path().'/assets/sass/normalize.scss [y/n]? ', false);
        }
        if ($appreplace) {
            if (!$is_workbench) {
                copy($templpath . '/templates/normalize.scss',app_path() . '/assets/sass'.'/normalize.scss');
            } else {
                file_put_contents(app_path() . '/assets/sass'.'/normalize.scss', str_replace('vendor','workbench',file_get_contents($templpath . '/templates/normalize.scss')));
            }
            $this->info('copy normalize.scss to '.app_path().'/assets/sass');
        }
*/
        $sereplace = true;
        if (file_exists(app_path() . '/assets/sass'.'/_settings.scss')) {
            $sereplace = $this->confirm('Do you want to replace '.app_path().'/assets/sass/_settings.css [y/n]? ', false);
        }
        if ($sereplace) {
                copy($templpath . '/templates/_settings.scss',app_path() . '/assets/sass'.'/_settings.scss');
            $this->info('copy _settings.scss to '.app_path().'/assets/sass');
        }

        $sereplace = true;
        if (file_exists(app_path() . '/assets/sass'.'/_main.scss')) {
            $sereplace = $this->confirm('Do you want to replace '.app_path().'/assets/sass/_main.css [y/n]? ', false);
        }
        if ($sereplace) {
                copy($templpath . '/templates/_main.scss',app_path() . '/assets/sass'.'/_main.scss');
            $this->info('copy _main.scss to '.app_path().'/scss');
        }

        if (!file_exists(public_path() . '/css')) {
            mkdir(public_path() . '/css');
            $this->info('created directory: '.public_path().'/css');
        }

        if (!file_exists(public_path() . '/img')) {
            mkdir(public_path() . '/img');
            $this->info('created directory: '.public_path().'/img');
        }

        if (!file_exists(storage_path() . '/.sass-cache')) {
            mkdir(storage_path() . '/.sass-cache');
            $this->info('created directory: '.storage_path().'/.sass-cache');
           
            if (file_exists(storage_path() . '/.sass-gitignore')) {
                $gi = file_get_contents(storage_path() . '/.gitignore');
            } else {$gi='';}
            if (!strpos($gi, '.sass-cache')) {
                file_put_contents(storage_path() . '/.gitignore', $gi . "\n.sass-cache\n");
                $this->info('add directory to .gitignore: '.storage_path().'/.sass-cache');
            }
        }
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