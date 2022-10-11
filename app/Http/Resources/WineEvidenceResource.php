<?php declare(strict_types = 1);

namespace App\Http\Resources;

use App\Models\Project;
use App\Models\Wine;
use App\Models\WineClassification;
use App\Models\WineEvidence;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class WineEvidenceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            WineEvidence::ID => $this->id,
            'project' => ProjectResource::make(Project::findOrFail($this->project_id)),
            'wine' => WineResource::make(Wine::findOrFail($this->wine_id)),
            'wine_classification' => WineClassification::findOrFail($this->wine_classification_id),
            WineEvidence::TITLE => $this->title,
            WineEvidence::VOLUME => $this->volume,
            WineEvidence::YEAR => $this->year,
            WineEvidence::ALCOHOL => $this->alcohol,
            WineEvidence::ACID => $this->acid,
            WineEvidence::SUGAR => $this->sugar,
        ];
    }
}
