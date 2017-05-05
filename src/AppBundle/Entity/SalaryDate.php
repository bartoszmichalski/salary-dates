<?php

namespace AppBundle\Entity;

/**
 * Description of SalaryDate
 *
 * @author bartosz
 */
class SalaryDate
{
    private $month;
    private $base;
    private $bonus;
    
    public function setMonth($month)
    {
        $this->month = $month;
        
        return $this;
    }
    
    public function getMonth()
    {
        return $this->month;
    }
    
    public function setBase($base)
    {
        $this->base = $base;
        
        return $this;
    }
    
    public function getBase()
    {
        return $this->base;
    }
    
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;
    
        return $this;
    }
    
    public function getBonus()
    {
        return $this->bonus;
    }
        
}
