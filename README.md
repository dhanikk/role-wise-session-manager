# Role Wise Session Manager

## Overview
This package allows you to manage session lifetimes based on user roles in Laravel.

## Installation
You can install the package using Composer:

```sh
composer require itpathsolutions/role-wise-session-manager
```

## Publishing the Provider
After installation, publish the provider using the following command:

```sh
php artisan vendor:publish --provider="Itpathsolutions\Sessionmanager\SessionManagerServiceProvider"
```

## Middleware Configuration
You need to add the middleware inside `app/Http/Kernel.php` in the middleware groups:

```php
protected $middlewareGroups = [
    'web' => [
        // Your other middleware
        \Itpathsolutions\Sessionmanager\Http\Middleware\RoleBasedSessionMiddleware::class,
    ],

    'api' => [
        //
    ],
];
```

## Managing Session Lifetime
You can check and configure session lifetime based on roles using the following URL:

```
http://127.0.0.1:8000/session-manager-info
```

The default session lifetime is set to **30 minutes per role**, but you can modify it as needed, and changes will take effect in your system.

---

Enjoy managing session lifetimes efficiently with Role Wise Session Manager!
