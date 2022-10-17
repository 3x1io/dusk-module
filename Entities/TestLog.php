<?php

namespace Modules\Dusk\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $model_type
 * @property string $model_id
 * @property string $log
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 */
class TestLog extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['model_type', 'model_id', 'log', 'type', 'created_at', 'updated_at'];
}
