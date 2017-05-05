<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Entity;

/**
 * Description of SalaryDate
 *
 * @author bartosz
 */
class SalaryDate
{
    private $base;
    private $bonus;
    
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
