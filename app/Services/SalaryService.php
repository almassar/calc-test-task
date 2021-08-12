<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Tax;

class SalaryService
{
    public const MZP = 42500;

    public const MRP = 2917;

    public const PERCENT_ADJUSTMENT = 0.9;

    public const LIMIT_ADJUSTMENT = 0.9;

    static private $employee;

    static private $tax;

    public function __construct($parameters)
    {
        self::$employee = Employee::create(['is_pensioner'     => $parameters['is_pensioner'],
                                            'disability_group' => $parameters['disability_group'],
                                            'is_mzp' => $parameters['is_mzp'],
                                            'salary' => $parameters['salary']]);

        self::$tax = Tax::getPercent($parameters['id_month'], $parameters['id_year']);                                        
    }

    public static function calculate()
    {
        // Если пенсионер                                
        if(self::$employee->isPensioner()){
            $pension_contribution = 0;
            $social_contribution  = 0;
            $vosms = 0;
            $osms  = 0;
            
            $adjustment = self::calculateAdjustment(self::$employee->salary, $pension_contribution, self::$employee->is_mzp, $vosms);
            $ipn = (self::$employee->salary - $pension_contribution - self::MZP * self::$employee->is_mzp - $vosms - $adjustment) * self::$tax->ipn;
        }                                

        // Если пенсионер с инвалидностью
        if(self::$employee->isPensionerAndDisability()){
            $pension_contribution = 0;
            $social_contribution  = 0;
            $vosms = 0;
            $osms  = 0;
            $ipn = 0;
        }  

        // Инвалид 1 или 2 группы
        if(self::$employee->isDisabilityOneAndTwo()){
            $pension_contribution = 0;
            $social_contribution  = self::$employee->salary * self::$tax->social_contribution;
            $vosms = 0;
            $osms  = 0;
            $ipn = 0;
        }   

        // Инвалид 3 группы
        if(self::$employee->isDisabilityThree()){
            $pension_contribution = self::$employee->salary * self::$tax->pension_contribution;
            $social_contribution  = self::$employee->salary * self::$tax->social_contribution;
            $vosms = 0;
            $osms  = 0;
            $ipn = 0;
        }

        // Инвалид у которого, зарплата превысила лимит
        if(self::$employee->isDisability() && self::$employee->isExceedSalary()) {
            $adjustment = self::calculateAdjustment(self::$employee->salary, $pension_contribution, self::$employee->is_mzp, $vosms);
            $ipn = (self::$employee->salary - $pension_contribution - self::MZP * self::$employee->is_mzp - $vosms - $adjustment) * self::$tax->ipn;
        } 

        // Обычный сотрудник
        if(self::$employee->isNormal()){
            $pension_contribution = self::$employee->salary * self::$tax->pension_contribution;
            $social_contribution = (self::$employee->salary - $pension_contribution) * self::$tax->social_contribution;
            $vosms = self::$employee->salary * self::$tax->vosms;
            $osms = self::$employee->salary * self::$tax->osms;
    
            $adjustment = self::calculateAdjustment(self::$employee->salary, $pension_contribution, self::$employee->is_mzp, $vosms);
            $ipn = (self::$employee->salary - $pension_contribution - self::MZP * self::$employee->is_mzp - $vosms - $adjustment) * self::$tax->ipn;
        }

        $salary_result = self::$employee->salary - $pension_contribution - $social_contribution - $vosms - $osms - $ipn;


        return  ['pension_contribution' => $pension_contribution,          
                 'social_contribution'  => $social_contribution,         
                 'vosms' => $vosms, 
                 'osms' => $osms, 
                 'ipn' => $ipn, 
                 'salary' => self::$employee->salary, 
                 'salary_result' => $salary_result];
    }


    /** Вычисление корректировки */
    private static function calculateAdjustment($salary, $pension_contribution, $is_mzp, $vosms)
    {
        if($salary < self::LIMIT_ADJUSTMENT * self::MRP){
            return ($salary - $pension_contribution - self::MZP * $is_mzp - $vosms) * self::PERCENT_ADJUSTMENT;
        }

        return 0;
    }
    
}
