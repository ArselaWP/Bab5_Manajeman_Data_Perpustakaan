<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'member_code'   => $this->member_code,
            'email'         => $this->email,
            'phone'         => $this->phone ?? '-',
            'address'       => $this->address ?? '-',
            'status'        => $this->status,
            'joined_at'     => $this->joined_at,
        ];
    }
}
