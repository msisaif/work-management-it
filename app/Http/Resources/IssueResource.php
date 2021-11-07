<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IssueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                => (int) $this->id,
            'projectId'         => (int) $this->project_id,
            'projectName'       => (string) ($this->project->name ?? ''),
            'projectNicname'    => (string) ($this->project->nikname ?? ''),
            'userId'            => (int) $this->user_id,
            'userName'          => (string) ($this->user->name ?? ''),
            'title'             => (string) ($this->title ?? ''),
            'body'              => (string) ($this->body ?? ''),
            'active'            => (boolean) ($this->active ?? false),
            'type'              => (int) ($this->type ?? 0),
            'workType'          => (string) ($this->work_type ?? ''),
            'createdDate'       => (string) ($this->created_at ? $this->created_at->format('d M Y') : ''),
            'createdTime'       => (string) ($this->created_at ? $this->created_at->format('g:i A') : ''),
        ];
    }
}
