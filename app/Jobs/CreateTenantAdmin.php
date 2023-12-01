<?php

namespace App\Jobs;

use App\Models\CentralUser;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreateTenantAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Tenant $tenant)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $globalId = Auth::user()->global_id;
        $this->tenant->run(function ($tenant) use ($globalId) {
            try {
                $owner = User::create([
                    'global_id' => $globalId,
                    'first_name' => $tenant->first_name,
                    'last_name' => $tenant->last_name,
                    'email' => $tenant->email,
                    'password' => $tenant->password,
                ]);
                $owner->assignRole('owner');
            } catch (\Throwable $th) {
                //throw $th;
            }
        });
    }
}
