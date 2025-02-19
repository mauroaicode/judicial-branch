<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Listeners;

use Tenancy\Affects\URLs\Events\ConfigureURL;

class ConfigureApplicationUrl
{
    public function handle(ConfigureURL $event)
    {
        if($tenant = $event->event->tenant) {
            //$event->changeRoot(config('app.url') . '/' . $tenant->slug);
        }
    }
}
