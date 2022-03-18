<?php

namespace App\Models;

use Database\Factories\AccountingDocumentTypeFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\AccountingDocumentType
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static AccountingDocumentTypeFactory factory(...$parameters)
 * @method static Builder|AccountingDocumentType newModelQuery()
 * @method static Builder|AccountingDocumentType newQuery()
 * @method static Builder|AccountingDocumentType query()
 * @method static Builder|AccountingDocumentType whereCode($value)
 * @method static Builder|AccountingDocumentType whereCreatedAt($value)
 * @method static Builder|AccountingDocumentType whereId($value)
 * @method static Builder|AccountingDocumentType whereTitle($value)
 * @method static Builder|AccountingDocumentType whereUpdatedAt($value)
 * @mixin Eloquent
 */
class AccountingDocumentType extends Model
{
    use HasFactory;

    public const TITLE = "title";
    public const CODE = "code";
}
