<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Type;
use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * - Attributes.
 *
 * @property int $id
 * @property string $contact_name
 * @property string|null $name
 * @property string $email
 * @property string|null $company
 * @property int $phone
 * @property Type $type
 * @property string $siret
 * @property string $tva_intra
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * - Relations.
 * @property Collection<int,Worksite>|null $worksites
 * @property Address|null $address
 */

class Client extends Model
{
    /** @use HasFactory<ClientFactory> */
    use HasFactory;

    /**
     * @var array<int,string>
     */
    protected $guarded = ['id'];

    public function worksites(): HasMany
    {
        return $this->hasMany(Worksite::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
