<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class DeleteInactiveAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lms:delete-inactive-accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all inactive accounts';

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
        $admins = $this->anticipate('Do you wish to include Admins to? [Y|N]', ['Y', 'N'], false);

        $users = DB::table('users')
                   ->where('status', '=', '0')
                   ->where(function ($query) use ($admins) {
                       if ($admins == 'N') {
                           $query->where('type', '=', 'Member');
                       }
                   })
                   ->delete();
        $this->info($users . ' users are deleted.');
        Log::info('Delete Inactive Account command: [' . $users . ' users are deleted.]');

    }
}
