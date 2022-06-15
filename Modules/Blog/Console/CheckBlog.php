<?php

namespace Modules\Blog\Console;

use Illuminate\Console\Command;
use Modules\Blog\Entities\Blog;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CheckBlog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

//    protected $name = 'check:blog';
    protected $name= 'check:blog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the total number of blog.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        parent::__construct($name);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        echo Blog::count() . "\n";
        $blogs = Blog::all();
        foreach ($blogs as $blog){
            Log::debug($blog);
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
