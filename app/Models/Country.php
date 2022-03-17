<?php

namespace App\Models;

use Database\Factories\CountryFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @method static CountryFactory factory(...$parameters)
 * @method static Builder|Country newModelQuery()
 * @method static Builder|Country newQuery()
 * @method static Builder|Country query()
 * @method static Builder|Country whereCode($value)
 * @method static Builder|Country whereId($value)
 * @method static Builder|Country whereTitle($value)
 * @mixin Eloquent
 */
class Country extends Model
{
    use HasFactory;

    public const TITLE = "title";
    public const CODE = "code";
    public const CALLING_CODE = "calling_code";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::TITLE,
        self::CODE,
        self::CALLING_CODE,
    ];
}
