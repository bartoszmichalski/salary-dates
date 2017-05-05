<?php

namespace AppBundle\Entity;

use AppBundle\Entity\SalaryDate;
/**
 * Description of SalaryDateCalculations
 *
 * @author bartosz
 */
class SalaryDateCalculations
{
    public function setSalaryMonth(SalaryDate $salaryDate, $date)
    {
        $monthName = date('F', $date);
        $salaryDate->setMonth($monthName);
    }
    
    public function setSalaryBase(SalaryDate $salaryDate, $date)
    {
        $basePaymentDate = date('t', $date);
        
        $numberDayInWeek = date('N', $this->getLastDayOfMonthTimestamp($date));
        
        if ($numberDayInWeek == 6) {
            $basePaymentDate -= 1;
        }
        if ($numberDayInWeek == 7) {
            $basePaymentDate -= 2;
        }
        $salaryDate->setBase(date('Y m '.$basePaymentDate, $date));       
    }
    
    public function setSalaryBonus(SalaryDate $salaryDate, $date)
    {
        $lastDayTimestamp = $this->getLastDayOfMonthTimestamp($date);
        $bonusPaymentDate = strtotime('+15days', $lastDayTimestamp);
        $numberDayInWeek = date('N', $bonusPaymentDate);
        if ($numberDayInWeek > 5) {
            $bonusPaymentDate = strtotime('next Wednesday', $bonusPaymentDate);
        }
        var_dump($bonusPaymentDate);
        $salaryDate->setBonus(date('Y m d',$bonusPaymentDate));
    }
    private function getLastDayOfMonthTimestamp($date)
    {
        return mktime(0, 0, 0, date('m', $date), date('t', $date), date('Y',$date));      
    }

}
