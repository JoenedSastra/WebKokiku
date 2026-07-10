<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = ['key', 'value'];

    public $timestamps = true;

    public static function get(string $key, $default = null)
    {
        if (! Schema::hasTable((new self())->getTable())) {
            return $default;
        }

        try {
            $record = self::where('key', $key)->first();
        } catch (QueryException $e) {
            return $default;
        }

        if ($record) {
            return $record->value;
        }

        return $default;
    }

    public static function set(string $key, $value): ?self
    {
        if (! Schema::hasTable((new self())->getTable())) {
            return null;
        }

        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
