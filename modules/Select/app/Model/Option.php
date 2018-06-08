<?php

namespace Select\Model;

use GeDuc\Model\BaseModel;

/**
 * @property int $id
 * @property string $slug
 * @property string $label
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Option extends BaseModel
{
    /**
     * @var array
     */
    protected $fillable = ['slug', 'label', 'order', 'description', 'created_at', 'updated_at', 'deleted_at'];

    public function findBySlug($slug, $orderBy, $order)
    {
        return $this->select('id', 'label')
            ->orderBy($orderBy, $order)
            ->where('slug', $slug);
    }
}
