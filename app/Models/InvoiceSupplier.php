<?php

declare(strict_types=1);

namespace App\Models;

use Cknow\Money\Casts\MoneyIntegerCast;
use Cknow\Money\Money;
use Database\Factories\InvoiceSupplierFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Override;

/**
 * - Attributes.
 *
 * @property int $id
 * @property Carbon $delivery_date
 * @property string $number_invoice
 * @property string $Invoice_description
 * @property Money $purchase_price
 * @property Money $cost_price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * - Relations.
 * @property Collection<int,Worksite>|null $worksite
 */
class InvoiceSupplier extends Model
{
    /** @use HasFactory<InvoiceSupplierFactory> */
    use HasFactory, SoftDeletes;

    /**
     * @var array<int,string>
     */
    protected $guarded = ['id'];

    #[Override]
    protected function casts(): array
    {
        return [
            'delivery_date' => 'datetime',
            'purchase_price' => MoneyIntegerCast::class,
            'cost_price' => MoneyIntegerCast::class,
        ];
    }

    public function worksite(): BelongsTo
    {
        return $this->belongsTo(Worksite::class);
    }
}
