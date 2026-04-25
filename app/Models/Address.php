<?php

namespace App\Models;

use Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * - Attributes.
 *
 * @property int $id
 * @property string $street
 * @property string $city
 * @property int $zip_code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * - Relations.
 * @property Collection<int,Worksite> $worksites
 * @property Collection<int,Client> $clients
 */
class Address extends Model
{
    /** @use HasFactory<AddressFactory> */
    use HasFactory;

    /**
     * @var array<int,string>
     */
    protected $guarded = ['id'];

    public function worksites(): HasMany
    {
        return $this->hasMany(Worksite::class);
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
