<?php

namespace App\Traits;

use App\Models\ActionLog;
use Illuminate\Support\Facades\Request;

trait Loggable
{
    public static function bootLoggable()
    {
        static::created(function ($model) {
            self::log('created', $model);
        });

        static::updated(function ($model) {
            self::log('updated', $model);
        });

        static::deleted(function ($model) {
            self::log('deleted', $model);
        });
    }

    protected static function log($action, $model)
    {
        ActionLog::create([
            'model' => get_class($model),
            'model_id' => $model->id,
            'action' => $action,
            'user_id' => auth()->id(),
            'old_values' => $action === 'updated' ? json_encode($model->getOriginal()) : null,
            'new_values' => $action === 'updated' ? json_encode($model->getChanges()) : ($action === 'created' ? json_encode($model->getAttributes()) : null),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}