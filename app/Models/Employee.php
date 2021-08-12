<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['is_pensioner', 'disability_group', 'is_mzp', 'salary'];

    public const LIMIT_SALARY = 25;
   
    public function isPensioner()
    {
        return $this->is_pensioner !== 0 && $this->disability_group === 0;
    }

    public function isPensionerAndDisability()
    {
        return $this->is_pensioner !== 0 && ($this->disability_group > 0);
    }

    public function isDisabilityOneAndTwo()
    {
        return $this->is_pensioner === 0 && in_array($this->disability_group, [1, 2]);
    }

    public function isDisabilityThree()
    {
        return $this->is_pensioner === 0 && $this->disability_group === 3;
    }

    public function isDisability()
    {
        return $this->is_pensioner === 0 && $this->disability_group > 0;
    }

    public function isExceedSalary()
    {
        return $this->salary < self::LIMIT_SALARY * SalaryService::MRP;
    }

    public function isNormal()
    {
        return $this->is_pensioner !== 0 && $this->disability_group !== 0;
    }

}
