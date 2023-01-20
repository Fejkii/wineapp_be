<?php declare(strict_types = 1);

namespace App\Http\Resources;

use App\Models\Vineyard;
use App\Models\VineyardWine;
use App\Models\Wine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class VineyardWineResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            VineyardWine::ID => $this->id,
            VineyardWine::VINEYARD_ID => $this->vineyard_id,
            'wine' => Wine::findOrFail($this->wine_id),
            VineyardWine::TITLE => $this->title,
            VineyardWine::QUANTITY => $this->quantity,
            VineyardWine::NOTE => $this->note,
            Model::CREATED_AT => $this->created_at,
            Model::UPDATED_AT => $this->updated_at,
        ];
    }
}
