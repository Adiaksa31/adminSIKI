<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Session;
use App\Helpers\ApiHelper;

class FetchPermissions extends Command
{
    protected $signature = 'fetch:permissions';
    protected $description = 'Fetch permissions from the API and store in session';

    public function handle()
    {
        $ids = Session::get('ids');
        if ($ids) {
            $data = ApiHelper::request("GET", "/admin/{$ids}/get_permission")['data'];
            session()->put('permission', $data);
            $this->info('Permissions fetched and stored in session.');
        } else {
            $this->error('No IDs found in session.');
        }
    }
}
