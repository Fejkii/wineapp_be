<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WineClassification extends Model
{
    use HasFactory;

    public const TITLE = "title";
    public const CODE = "code";
    public const PARAMS = "params";
}
