<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;

    public function getSubtotalAttribute()
    {
        return number_format($this->qty * $this->price);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
