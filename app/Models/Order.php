<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_code',
        'total_amount',
        'status', 
        'payment_status', 
        'start_date',
        'end_date',
        'notes',
    ];

    protected $casts = [ 
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Product
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    // Accessor untuk mendapatkan durasi
    public function getDurationAttribute()
    {
        return $this->start_date->diffInDays($this->end_date) + 1; // +1 untuk include hari terakhir
    }

    // Method untuk format durasi
    public function getDurationText()
    {
        $days = $this->duration;
        return $days . ' hari' . ($days > 1 ? '' : '');
    }

    // Scope untuk cek overlap
    public function scopeOverlapping($query, $startDate, $endDate, $excludeOrderId = null)
    {
        $query->where('status', '!=', 'canceled')
              ->where(function($q) use ($startDate, $endDate) {
                  $q->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function($q2) use ($startDate, $endDate) {
                        $q2->where('start_date', '<=', $startDate)
                           ->where('end_date', '>=', $endDate);
                    });
              });

        if ($excludeOrderId) {
            $query->where('id', '!=', $excludeOrderId);
        }

        return $query;
    }

    // Method untuk check availability
    public static function isDateRangeAvailable($startDate, $endDate, $excludeOrderId = null)
    {
        return !self::overlapping($startDate, $endDate, $excludeOrderId)->exists();
    }

    // Scope untuk order yang aktif pada tanggal tertentu
    public function scopeActiveOnDate($query, $date = null)
    {
        $date = $date ?: today();
        
        return $query->where('start_date', '<=', $date)
                    ->where('end_date', '>=', $date)
                    ->where('status', 'active');
    }

    // Scope untuk order di range tanggal
    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate]);
    }

    // Scope untuk order yang akan datang
    public function scopeUpcoming($query, $days = 7)
    {
        return $query->where('start_date', '>=', today())
                    ->where('start_date', '<=', today()->addDays($days));
    }
}
