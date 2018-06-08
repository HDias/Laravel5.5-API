@servers(['web' => 'deployer@192.168.18.251'])

@setup
    $releases_dir = '/var/www/gestao-educacional';
    $beginTime = date('d/m/Y H:i:s');
@endsetup

@task('env')
    echo "Iniciando copia de files({{ $beginTime }})"
    cd {{ $releases_dir .'/'. $env }}
    cp .env.example .env
    ls -la
@endtask

@task('seed_admin')
    cd {{ $releases_dir .'/'. $env }}
    php artisan db:seed --class=AdminUserTableSeeder --force
@endtask

@task('deploy')
    {{-- Updade Git--}}

    echo "******** INICIANDO DEPLOYMENT ({{ $beginTime }}) **************"
    cd {{ $releases_dir .'/'. $env }}
    git pull origin {{ $branch }}

    {{-- Fim Updade Git--}}

    {{-- Run Composer --}}
    echo "[START composer update ({{ $beginTime }})]"
    composer update --no-dev -q
    {{-- Fim Composer --}}

    @if($assets == 'gulp')
        echo "[START npm install gulp ({{ $beginTime }})]"
        npm install
        gulp --production

    @endif

    @if($assets == 'webpack')
        echo "[START npm install webpack ({{ $beginTime }})]"
        npm install
        npm run production
    @endif

    echo "[START ARTISAN ({{ $beginTime }})]"
    php artisan key:generate
    php artisan cache:forget lang.js
    php artisan config:cache

    {{-- MIGRATE --}}

    php artisan migrate --seed --force

    echo "********* DEPLOY FINALIZADO ************"
@endtask

@task('deployRefresh')
    echo "******** Iniciado DEPLOYMENT REFRESH ({{ $beginTime }}) **************"

    {{-- GIT UPDATE --}}
    cd {{ $releases_dir .'/'. $env }}
    git pull origin {{ $branch }}
    {{-- Fim Updade Git--}}

    {{-- Run Composer --}}
    echo "[START composer update ({{ $beginTime }})]"
    composer update --no-dev -q
    {{-- Fim Composer --}}

    @if($assets == 'gulp')
        echo "[START npm install gulp ({{ $beginTime }})]"
        npm install
        gulp --production
    @endif

    @if($assets == 'webpack')
        echo "[START npm install webpack ({{ $beginTime }})]"
        npm install
        npm run production
    @endif

    echo "[START ARTISAN]"
    php artisan key:generate --force
    php artisan cache:forget lang.js
    php artisan config:cache

    {{-- MIGRATE --}}
    php artisan migrate:reset --force
    php artisan migrate --seed --force
    php artisan louzada:create:permission --force

    echo "********* DEPLOY FINALIZADO ************"
@endtask

@task('migrate')
    echo "[Ciação de Tabelas INICIADA]"
    cd {{ $releases_dir .'/'. $env }}
    php artisan migrate --force
    echo "[FINALIZADO]"
@endtask

@task('migrateRefresh')
    echo "[Ciação de Tabelas INICIADA]"
    cd {{ $releases_dir .'/'. $env }}
    php artisan migrate:reset --force
    php artisan migrate --seed --force
    php artisan louzada:create:permission --force
    echo "[FINALIZADO]"
@endtask

@task('permissions')
    echo "[Ciação de Permissions INICIADA]"
    {{-- Create Permissions from routes --}}
    cd {{ $releases_dir .'/'. $env }}
    php artisan louzada:create:permission --force
    {{-- Fim ARTISAN --}}
    echo "[FINALIZADO]"
@endtask