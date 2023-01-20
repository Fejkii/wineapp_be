<?php declare(strict_types = 1);

namespace App\Http\Resources;

use App\Models\Project;
use App\Models\Vineyard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class VineyardResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            Vineyard::ID => $this->id,
            'project' => Project::findOrFail($this->project_id),
            Vineyard::TITLE => $this->title,
            Model::CREATED_AT => $this->created_at,
            Model::UPDATED_AT => $this->updated_at,
        ];
    }
}
