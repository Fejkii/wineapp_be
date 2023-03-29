<?php

namespace App\Http\Resources;

use App\Models\VineyardRecord;
use App\Models\VineyardRecordType;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class VineyardRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            VineyardRecord::ID => $this->id,
            VineyardRecord::VINEYARD_WINE_ID => $this->wine_evidence_id,
            VineyardRecord::VINEYARD_RECORD_TYPE => VineyardRecordType::findOrFail($this->vineyard_record_type_id),
            VineyardRecord::TITLE => $this->title,
            VineyardRecord::DATA => $this->data,
            VineyardRecord::DATE => $this->date,
            VineyardRecord::IS_IN_PROGRESS => $this->is_in_progress,
            VineyardRecord::DATE_TO => $this->date,
            VineyardRecord::NOTE => $this->note,
            Model::CREATED_AT => $this->created_at,
            Model::UPDATED_AT => $this->updated_at,
        ];
    }
}
