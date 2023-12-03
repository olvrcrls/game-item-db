<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class UserResourceDatum extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'discord_id' => Str::substrReplace($this->discord_id, '****', 2, 10),
            'email' => Str::substrReplace($this->email, '****', 2, 7),
            'email-verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at
            // Only return if admin user
            // 'username' => $this->username,
        ];
    }
}
