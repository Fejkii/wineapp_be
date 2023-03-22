<?php

namespace App\Http\Resources;

use App\Models\WineRecord;
use App\Models\WineRecordType;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class WineRecordResource extends JsonResource
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
            WineRecord::ID => $this->id,
            WineRecord::WINE_EVIDENCE_ID => $this->wine_evidence_id,
            WineRecord::WINE_RECORD_TYPE => WineRecordType::findOrFail($this->wine_record_type_id),
            WineRecord::DATE => $this->date,
            WineRecord::TITLE => $this->title,
            WineRecord::DATA => $this->data,
            WineRecord::NOTE => $this->note,
            Model::CREATED_AT => $this->created_at,
            Model::UPDATED_AT => $this->updated_at,
        ];
    }
}
