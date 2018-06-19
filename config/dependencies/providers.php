<?php

$production = [
    /*
     * Laravel Framework Service Providers...
     */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    Illuminate\Database\DatabaseServiceProvider::class,
    Illuminate\Encryption\EncryptionServiceProvider::class,
    Illuminate\Filesystem\FilesystemServiceProvider::class,
    Illuminate\Foundation\Providers\FoundationServiceProvider::class,
    Illuminate\Hashing\HashServiceProvider::class,
    Illuminate\Mail\MailServiceProvider::class,
    Illuminate\Notifications\NotificationServiceProvider::class,
    Illuminate\Pagination\PaginationServiceProvider::class,
    Illuminate\Pipeline\PipelineServiceProvider::class,
    Illuminate\Queue\QueueServiceProvider::class,
    Illuminate\Redis\RedisServiceProvider::class,
    Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
    Illuminate\Session\SessionServiceProvider::class,
    Illuminate\Translation\TranslationServiceProvider::class,
    Illuminate\Validation\ValidationServiceProvider::class,
    Illuminate\View\ViewServiceProvider::class,

    /*
     * Package Service Providers...
     */

    /*
     * Application Service Providers...
     */
    API\Providers\APIServiceProvider::class,
    API\Providers\AuthServiceProvider::class,
    // API\Providers\BroadcastServiceProvider::class,
    API\Providers\EventServiceProvider::class,
    API\Providers\RouteServiceProvider::class,

    /*
     * Package Service Providers...
     */
    OwenIt\Auditing\AuditingServiceProvider::class,

    /**
     * https://github.com/Askedio/laravel-soft-cascade/tree/5.5.14
     */
    Askedio\SoftCascade\Providers\GenericServiceProvider::class,

    /**
     * http://jwt-auth.readthedocs.io/en/develop/laravel-installation/
     */
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,

    // \Audit\AuditServiceProvider::class,
    // ACL\ACLServiceProvider::class,
    // Select\SelectServiceProvider::class,
];

$local = [
    Krlove\EloquentModelGenerator\Provider\GeneratorServiceProvider::class,
];

$packages = $production;

if (env('APP_ENV') == 'local') {
    $packages = array_merge($production, $local);
}

return $packages;
