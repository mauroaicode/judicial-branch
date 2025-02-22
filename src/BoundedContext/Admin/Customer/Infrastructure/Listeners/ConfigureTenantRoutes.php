<?php

namespace Core\BoundedContext\Admin\Customer\Infrastructure\Listeners;

use Illuminate\Support\Facades\File;
use Tenancy\Affects\Routes\Events\ConfigureRoutes;
use Core\BoundedContext\Admin\Role\Infrastructure\Persistence\Eloquent\RoleModel;

class ConfigureTenantRoutes
{
    public function handle(ConfigureRoutes $event)
    {
        if ($event->event->tenant) {
            $basePath = base_path('src/BoundedContext/Tenant');
            $apiRoutes = File::glob($basePath . '/**/Infrastructure/routes/api.php');
            config('permission.models.role', RoleModel::class);

            foreach ($apiRoutes as $route) {
                $event->fromFile(['prefix' => '{tenant}/api'], $route);
            }
        }
    }
}
