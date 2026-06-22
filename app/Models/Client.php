<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ClientType;
use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Override;

/**
 * @property int $id
 * @property int $user_id
 * @property string $contact_name
 * @property string|null $name
 * @property string $email
 * @property string|null $company
 * @property string $phone
 * @property ClientType $type
 * @property string $street
 * @property string $city
 * @property int $zip_code
 * @property string $country
 * @property string $siret
 * @property string $tva_intra
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection<int,Worksite>|null $worksites
 * @property User $user
 */
class Client extends Model
{
    /** @use HasFactory<ClientFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    #[Override]
    protected function casts(): array
    {
        return [
            'type' => ClientType::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function worksites(): HasMany
    {
        return $this->hasMany(Worksite::class);
    }
}
