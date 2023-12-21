<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'category' => $this->category,
            'image' => $this->image,
            //asnwer a
            'answer_a' => $this->option_a,
            'answer_b' => $this->option_b,
            'answer_c' => $this->option_c,
            'answer_d' => $this->option_d,
        ];
    }
}
