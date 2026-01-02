<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class,
    Modules\Admin\Providers\AdminModuleServiceProvider::class,
    Modules\Users\Providers\UserModuleServiceProvider::class,
    Modules\Applications\Providers\ApplicationModuleServiceProvider::class,
    Modules\Jobs\Providers\JobsModuleServiceProvider::class,
    Modules\Auth\Providers\AuthModuleServiceProvider::class,
    Modules\Employers\Providers\EmployeeModuleServiceProvider::class,
];
