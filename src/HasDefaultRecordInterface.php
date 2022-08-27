<?php

declare(strict_types = 1);

namespace NeueCommerce\DefaultRecords;

use Illuminate\Database\Eloquent\Builder;

interface HasDefaultRecordInterface
{
    public function getDefault(): bool;

    public function isDefault(): bool;

    public function scopeWhereIsDefault(Builder $query): Builder;

    public function scopeWhereIsNotDefault(Builder $query): Builder;

    public static function findDefault(): self;
}
