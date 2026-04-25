<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Priority;
use App\Enums\Status;
use Database\Factories\WorksiteFactory;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * - Attributes.
 *
 * @property int $id
 * @property string|null $code
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property Priority $priority
 * @property Status $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * - Relations.
 * @property Client $client
 * @property Address|null $address
 */

class Worksite extends Model
{
    /** @use HasFactory<WorksiteFactory> */
    use HasFactory;

    /**
     * @var array<int,string>
     */
    protected $guarded = ['id'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
