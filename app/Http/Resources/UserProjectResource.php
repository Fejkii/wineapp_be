<?php

namespace App\Http\Resources;

use App\Models\Project;
use App\Models\User;
use App\Models\UserProject;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            UserProject::ID => $this->id,
            'project' => Project::findOrFail($this->project_id),
            'user' => User::findOrFail($this->user_id),
            UserProject::IS_DEFAULT => $this->is_default,
            UserProject::IS_OWNER => $this->is_owner,
            Model::CREATED_AT => $this->created_at,
            Model::UPDATED_AT => $this->updated_at,
        ];
    }
}
