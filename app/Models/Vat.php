<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    use HasFactory;

    public const TITLE = "title";
    public const VAT = "vat";
    public const IS_DEFAULT = "is_default";
}
