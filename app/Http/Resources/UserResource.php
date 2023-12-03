<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;

class UserResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        foreach ($this->collection as $user) {
            $data[] = [
                'username' => $user->username,
                'discord_id' => Str::substrReplace($user->discord_id, '****', 2, 10),
                'email' => Str::substrReplace($user->email, '****', 2, 7),
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at
            ];
        }
        return $data;
    }
}
