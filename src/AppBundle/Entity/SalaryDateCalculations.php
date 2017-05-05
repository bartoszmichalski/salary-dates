<?php

namespace AppBundle\Entity;

use AppBundle\Entity\SalaryDate;
/**
 * Description of SalaryDateCalculations
 *
 * @author bartosz
 */
class SalaryDateCalculations extends SalaryDate
{
    public function setSalaryMonth($date)
    {
        $this->setMonth(date('F', $date));
        
        return $this;
    }
    
    public function setSalaryBase($date)
    {
        $basePaymentDay = date('t', $date);       
        $numberDayInWeek = date('N', $this->getLastDayOfMonthTimestamp($date));        
        if ($numberDayInWeek == 6) {
            $basePaymentDay -= 1;
        }
        if ($numberDayInWeek == 7) {
            $basePaymentDay -= 2;
        }        
        $basePaymentTimestamp = mktime(0, 0, 0, date('m', $date), $basePaymentDay, date('Y',$date));
        $this->setBase(date('Y m d', $basePaymentTimestamp)); 
                
        return $this;
    }
    
    public function setSalaryBonus($date)
    {
        $bonusPaymentDate = strtotime('+15days', $this->getLastDayOfMonthTimestamp($date));
        if (date('N', $bonusPaymentDate) > 5) {
            $bonusPaymentDate = strtotime('next Wednesday', $bonusPaymentDate);
        }
        $this->setBonus(date('Y m d',$bonusPaymentDate));
                
        return $this;
    }
    
    private function getLastDayOfMonthTimestamp($date)
    {
        return mktime(0, 0, 0, date('m', $date), date('t', $date), date('Y',$date));      
    }

}
