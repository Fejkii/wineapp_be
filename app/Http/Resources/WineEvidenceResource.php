<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\WineClassification;
use App\Models\WineEvidence;
use App\Models\WineEvidenceWine;
use Illuminate\Database\Eloquent\Model;
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
            WineEvidence::PROJECT_ID => $this->project_id,
            WineEvidence::WINES => WineEvidenceWineResource::collection(WineEvidenceWine::whereWineEvidenceId($this->id)->get()),
            'wine_classification' => WineClassification::find($this->wine_classification_id),
            WineEvidence::TITLE => $this->title,
            WineEvidence::VOLUME => $this->volume,
            WineEvidence::YEAR => $this->year,
            WineEvidence::ALCOHOL => $this->alcohol,
            WineEvidence::ACID => $this->acid,
            WineEvidence::SUGAR => $this->sugar,
            WineEvidence::NOTE => $this->note,
            Model::CREATED_AT => $this->created_at,
            Model::UPDATED_AT => $this->updated_at,
        ];
    }
}
