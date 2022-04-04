<?php

namespace App\Console\Commands;

use App\Modules\Permissions\Repositories\PermissionRepository;
use Illuminate\Console\Command;

class AddPermissionBulk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:bulk-add {permission_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add bulk permission using console';

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
        $permissionName = $this->argument('permission_name');
        $this->info('Initializing bulk add for "' . $permissionName . '"');
        $permissionRepo = app(PermissionRepository::class);
        $permissionRepo->bulkStore($permissionName);
        $this->comment("Completed");
        return 1;
    }
}
