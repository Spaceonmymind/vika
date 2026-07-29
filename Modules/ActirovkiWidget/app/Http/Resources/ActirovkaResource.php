<?php

namespace Modules\ActirovkiWidget\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ActirovkiWidget\Dto\ActirovkaDto;

/** @mixin ActirovkaDto */
class ActirovkaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'school_shift' => $this->schoolShift,
            'status' => $this->status,
            'message' => $this->message,
            'row' => new RowResource($this->row),
        ];
    }
}
