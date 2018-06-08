<?php

namespace GeDuc;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Sendler\Scope\SoftDeleting;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property \Carbon\Carbon $deleted_at
 */
class BaseModel extends Model implements AuditableContract
{
    use SoftDeletes, Auditable, SoftCascadeTrait;

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSoftDeletes()
    {
        static::addGlobalScope(new SoftDeleting());
    }
}
