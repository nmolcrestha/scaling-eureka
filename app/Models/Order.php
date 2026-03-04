<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'subtotal',
        'tax',
        'shipping',
        'total',
        'shipping_address',
        'notes',
        'paid_at'
    ];

    protected function casts(): array
    {
        return [
            'shipping_address' => 'array',
            'paid_at' => 'datetime',
            'total' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            $order->order_number = 'ORD-' . strtoupper(uniqid());
        });
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}
