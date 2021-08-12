<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'salary' => $this->salary,
            'ipn' => $this->ipn,
            'pension_contribution' => $this->pension_contribution,
            'osms' => $this->osms,
            'vosms' => $this->vosms,
            'social_contribution' => $this->social_contribution,
            'salary_result' => $this->salary_result,
        ];
    }
}
