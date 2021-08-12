<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalaryRequest;
use App\Services\SalaryService;
use App\Http\Resources\SalaryResource;
use App\Models\Salary;

class SalaryController extends Controller
{
    public function calculate(SalaryRequest $request)
    {
        return (new SalaryService($request->validated()))::calculate();
    }

    public function calculateSave(SalaryRequest $request)
    {
        $result = (new SalaryService($request->validated()))::calculate();

        Salary::create($result);

        return $result;
    }
}
