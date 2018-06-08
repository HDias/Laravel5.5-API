<?php

// ACL.
$this->group(['prefix' => 'acl', 'middleware' => ['auth:web', 'needsPermission', 'needsRole']], function () {
    // Permissão.
    $this->group(['prefix' => 'permission'], function () {
//        $this->get('index/{idRole?}/{idUser?}', [
        $this->get('/', [
            'uses' => 'PermissionController@index',
            'as' => 'acl.permission.index',
            'is' => config('defender.superuser_role')
        ])->where(['idRole' => '\d+', 'idUser' => '\d+']);

        $this->get('edit/{id}', [
            'uses' => 'PermissionController@edit',
            'as' => 'acl.permission.edit',
            'is' => config('defender.superuser_role')
        ]);

        $this->put('update/{id}', [
            'uses' => 'PermissionController@update',
            'as' => 'acl.permission.update',
            'is' => config('defender.superuser_role')
        ]);
        $this->get('label-autocomplete', [
            'uses' => 'PermissionController@labelAutocomplete',
            'as' => 'acl.permission.label_autocomplete'
        ]);

        $this->get('name-autocomplete', [
            'uses' => 'PermissionController@nameAutocomplete',
            'as' => 'acl.permission.name_autocomplete'
        ]);
    });

    // Função.
    $this->group(['prefix' => 'role'], function () {
//        $this->get('index/{idPermission}/{idUser}', [
        $this->get('/', [
            'uses' => 'RoleController@index',
            'as' => 'acl.role.index',
            'shield' => 'role.index'
        ]);
        $this->get('create', [
            'uses' => 'RoleController@create',
            'as' => 'acl.role.create',
            'shield' => 'role.create'
        ]);
        $this->post('store', [
            'uses' => 'RoleController@store',
            'as' => 'acl.role.store',
            'shield' => 'role.create'
        ]);
        $this->get('edit/{id}', [
            'uses' => 'RoleController@edit',
            'as' => 'acl.role.edit',
            'shield' => 'role.edit'
        ]);
        $this->put('update/{id}', [
            'uses' => 'RoleController@update',
            'as' => 'acl.role.update',
            'shield' => 'role.edit'
        ]);
        $this->delete('destroy/{id}', [
            'uses' => 'RoleController@destroy',
            'as' => 'acl.role.destroy',
            'shield' => 'role.destroy'
        ]);
        $this->get('autocomplete', [
            'uses' => 'RoleController@autocomplete',
            'as' => 'acl.role.autocomplete',
            'shield' => 'role.create'
        ]);
    });

    // Permissão em Usuário.
    $this->get('permission-user/link/{id}', [
        'uses' => 'PermissionUserController@link',
        'as' => 'acl.permission_user.link',
        'shield' => 'permission_user.link'
    ]);
    $this->post('permission-user/store/{id}', [
        'uses' => 'PermissionUserController@store',
        'as' => 'acl.permission_user.store',
        'shield' => 'permission_user.link'
    ]);
});

// Add in blade template `<script src="/js/lang.js"></script>`
// https://medium.com/@serhii.matrunchyk/using-laravel-localization-with-javascript-and-vuejs-23064d0c210e
// Add in Vue: Vue.prototype.jsTrans = (string) => _.get(window.i18n, string);
$this->get('/js/lang.js', function () {
    // Para limpar o cache: php artisan cache:forget lang.js
//    $strings = Cache::remember('lang.js', 1, function () {
    $lang = config('app.locale');

    $files = glob(resource_path('lang/' . $lang . '/*.php'));
    $strings = [];

    foreach ($files as $file) {
        $name = basename($file, '.php');
        $strings[$name] = require $file;
    }

//        return $strings;
//    });

    header('Content-Type: text/javascript');
    echo('window.trans = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');

// Rotas para verificar se possui acesso
$this->get('/js/defender/permissions.js', function () {

    $permissions = \Auth::user()->getAllPermissions()->pluck('name');

    $strings['superUser'] = \Auth::user()->isSuperUser();
    $strings['suporte'] = \Auth::user()->isSuporte();

    $strings['permissions'] = $permissions;

    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.permissions');
