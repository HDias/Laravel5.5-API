<?php

namespace Sendler;

use Artesaos\Defender\Traits\HasDefender;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Sendler\Scope\SoftDeleting;
use Sendler\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements AuditableContract, UserResolver, JWTSubject
{
    use Notifiable, Auditable, SoftDeletes, HasDefender, SoftCascadeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    
    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSoftDeletes()
    {
        static::addGlobalScope(new SoftDeleting());
    }

    /**
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return Auth::check() ? Auth::user()->getAuthIdentifier() : null;
    }

    /**
     * Verifica se Usuário logado é suporte
     * Perfil de suporte está no arquivo de configuração em config/audith.php
     *
     * @return bool
     */
    public function isSuporte() : bool
    {
        return \Defender::hasRole(config('defender.restore_role'));
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function userLogged($username)
    {
        return $this->select('id', 'username')
            ->where('username', $username);
    }
}
