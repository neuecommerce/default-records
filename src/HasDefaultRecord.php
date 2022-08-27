<?php

declare(strict_types = 1);

namespace NeueCommerce\DefaultRecords;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use NeueCommerce\ModelCasts\BooleanCast;

trait HasDefaultRecord
{
    public function initializeHasDefaultRecord()
    {
        $this->casts['is_default'] = BooleanCast::class;

        $callback = function (Model $model) {
            if ($model->getOriginal('is_default') === false) {
                $model
                    ->query()
                    ->where('is_default', true)
                    ->update(['is_default' => false])
                ;
            }
        };

        static::updating($callback);

        static::saving($callback);
    }

    public function getDefault(): bool
    {
        return $this->is_default;
    }

    public function isDefault(): bool
    {
        return $this->getDefault() === true;
    }

    public function setAsDefault(): self
    {
        if ($this->getDefault() === false) {
            $this->is_default = true;
            $this->save();
        }

        return $this->fresh();
    }

    public function scopeWhereIsDefault(Builder $query): Builder
    {
        return $query->where('is_default', true);
    }

    public function scopeWhereIsNotDefault(Builder $query): Builder
    {
        return $query->where('is_default', false);
    }

    public static function findDefault(): self
    {
        return self::query()->whereIsDefault()->first();
    }
}
