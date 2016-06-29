<?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use App\User;
    use Carbon\Carbon;
    use DB;
    use Log;

    class FindInactiveAccounts extends Command
    {

        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'lms:find-inactive-accounts {--admin}';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Change users to inactive who did not login in last 2 months.';

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
            $limit = Carbon::now();
            $limit->subMonth(2);
            $users = DB::table('users')
                       ->where('lastLogin', '<=', $limit->format('Y-m-d h:i:s'))
                       ->where(function ($query) use ($admins) {
                           if ($admins == 'N') {
                               $query->where('type', '=', 'Member');
                           }
                       })
                       ->lockForUpdate()
                       ->update(['status' => 0]);
            $this->info($users . ' users are deactivated.');
            Log::info('Find Inactive Account command: [' . $users . ' users are deactivated.]');

        }
    }
