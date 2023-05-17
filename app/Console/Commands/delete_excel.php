<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class delete_excel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete excel file\'s yesterday';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $folder = public_path('excel/output');
        $files = Storage::files($folder);

        foreach ($files as $file) {
            if (Storage::lastModified($file) < $today->timestamp) {
                Storage::delete($file);
            }
        }
    }
}
