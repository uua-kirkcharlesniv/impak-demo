<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public static function booted()
    {
       static::creating(function ($tenant) {
          $tenant->password = Hash::make($tenant->password);
       });
    }

    public static function getCustomColumns(): array
    {
      return [
         'id',
         'organization_id',
      ];
   }

   public function users()
   {
       return $this->belongsToMany(CentralUser::class, 'tenant_users', 'tenant_id', 'global_user_id', 'id', 'global_id')
           ->using(TenantPivot::class);
   }

   public function primary_domain(): HasOne
   {
      return $this->hasOne(Domain::class)->where('is_primary', true);
   }

   public function route(string $route, array $parameters = [], bool $absolute = true): string
   {
      if (! $this->primary_domain) {
         throw new Exception('Tenant does not have a primary domain.');
      }

      $domain = $this->primary_domain->domain;
      $parts = explode('.', $domain);

      if (count($parts) === 1) {
         $domain = $domain . '.' . config('tenancy.main_domain');
      }

      return tenant_route($domain, $route, $parameters, $absolute);
   }
}