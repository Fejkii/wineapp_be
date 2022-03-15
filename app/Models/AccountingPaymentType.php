<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingPaymentType extends Model
{
    use HasFactory;

    public const ID = "id";
    public const TITLE = "title";
    public const CODE = "code";
}
