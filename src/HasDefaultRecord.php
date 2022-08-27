<?php

declare(strict_types = 1);

namespace NeueCommerce\DefaultRecords;

use Illuminate\Database\Eloquent\Builder;
use NeueCommerce\ModelCasts\BooleanCast;

trait HasDefaultRecord
{
    public function initializeHasDefaultRecord()
    {
        $this->casts['is_default'] = BooleanCast::class;
    }

    public function getDefault(): bool
    {
        return $this->is_default;
    }

    public function isDefault(): bool
    {
        return $this->getDefault() === true;
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
