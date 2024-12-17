<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiSoundResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'file_path' => $this->file_path,
            'size' => $this->size_bytes,
            'hash' => $this->md5_hash,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
