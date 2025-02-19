<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Listeners;
use Illuminate\Support\Facades\File;
use Tenancy\Affects\Routes\Events\ConfigureRoutes;

class ConfigureTenantRoutes
{
    public function handle(ConfigureRoutes $event)
    {
        if ($event->event->tenant) {
            $basePath = base_path('src/BoundedContext/Tenant');
            $apiRoutes = File::glob($basePath . '/**/Infrastructure/routes/api.php');
            config('permission.models.role', Core\BoundedContext\Admin\Role\Infrastructure\Persistence\Eloquent\RoleModel::class);

            foreach ($apiRoutes as $route) {
                $event->fromFile(['prefix' => '{tenant}/api'], $route);
            }
        }
    }
}
