<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Cknow\Money\Casts\MoneyIntegerCast;
use Cknow\Money\Money;
use Database\Factories\InvoiceClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * - Attributes.
 *
 * @property int $id
 * @property Carbon $delivery_date
 * @property string $number_invoice
 * @property string $invoice_description
 * @property Money $total_ht
 * @property Carbon|null $payment_date
 * @property PaymentStatus $payment_status
 * @property PaymentMethod|null $payment_method
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * - Relations.
 * @property Collection<int,Worksite> $worksite
 * @property Collection<int,Quote>|null $quote
 * @property Client $client
 */
class InvoiceClient extends Model
{
    /** @use HasFactory<InvoiceClientFactory> */
    use HasFactory, SoftDeletes;

    /**
     * @var array<int,string>
     */
    protected $guarded = ['id'];

    #[\Override]
    protected function casts(): array
    {
        return [
            'delivery_date' => 'datetime',
            'total_ht' => MoneyIntegerCast::class,
            'payment_date' => 'datetime',
            'payment_status' => PaymentStatus::class,
            'payment_method' => PaymentMethod::class,
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function worksite(): BelongsTo
    {
        return $this->belongsTo(Worksite::class);
    }

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}
