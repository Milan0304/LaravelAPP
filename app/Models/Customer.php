<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function invoices() {
        return $this->hasMany(Invoice::class);

    }
    public function detail() {
        return $this->hasManyThrough(InvoiceDetails::class, Invoice::class);
    }
}
