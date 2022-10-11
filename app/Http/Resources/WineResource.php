<?php declare(strict_types = 1);

namespace App\Http\Resources;

use App\Models\Project;
use App\Models\Wine;
use App\Models\WineVariety;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class WineResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            Wine::ID => $this->id,
            'project' => Project::findOrFail($this->project_id),
            'wine_variety' => WineVariety::findOrFail($this->wine_variety_id),
            Wine::TITLE => $this->title,
        ];
    }
}
