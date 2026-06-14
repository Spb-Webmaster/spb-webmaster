<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Setting extends Model
{
    protected $fillable = ['group', 'data'];

    protected $casts = [
        'data' => 'array',
    ];

    private array $reserved = ['id', 'group', 'data', 'created_at', 'updated_at'];

    public static function getGroup(string $group): self
    {
        return static::firstOrCreate(['group' => $group], ['data' => []]);
    }

    // Позволяет MoonShine читать поля из data как прямые атрибуты
    public function getAttribute($key): mixed
    {
        if (!in_array($key, $this->reserved, true)) {
            $data = parent::getAttribute('data') ?? [];
            if (array_key_exists($key, $data)) {
                return $data[$key];
            }
        }
        return parent::getAttribute($key);
    }

    // Позволяет MoonShine писать Image-пути и другие поля прямо в data
    public function setAttribute($key, $value): mixed
    {
        if (!in_array($key, $this->reserved, true)) {
            $data = parent::getAttribute('data') ?? [];
            $data[$key] = $value;
            return parent::setAttribute('data', $data);
        }
        return parent::setAttribute($key, $value);
    }

    public function getValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->data, $key, $default);
    }

    public function cities(): BelongsToMany
    {
        return $this->belongsToMany(City::class);
    }
}
