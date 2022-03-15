<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingDocumentPaymentState extends Model
{
    use HasFactory;

    public const TITLE = "title";
    public const COLOR = "color";
    public const IS_INITIAL = "is_initial";
}
