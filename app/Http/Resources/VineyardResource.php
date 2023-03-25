<?php declare(strict_types = 1);

namespace App\Http\Resources;

use App\Models\Project;
use App\Models\Vineyard;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 *
 * Transform the resource into an array.
 *
 * @param  Request  $request
 * @return array|Arrayable|JsonSerializable
 */
class VineyardResource extends JsonResource
{
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            Vineyard::ID => $this->id,
            'project' => Project::findOrFail($this->project_id),
            Vineyard::TITLE => $this->title,
            Vineyard::AREA => $this->area,
            Model::CREATED_AT => $this->created_at,
            Model::UPDATED_AT => $this->updated_at,
        ];
    }
}
