<?php

namespace AppBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Entity\SalaryDateCalculations;

/**
 * Description of SalaryDateCalculationsTest
 *
 * @author bartosz
 */
class SalaryDateCalculationsTest extends WebTestCase
{
    public function testSetSalaryMonth()
    {
        $salaryDateCalulation = new SalaryDateCalculations;
        $salaryDateCalulation->setSalaryMonth(1491635897);
        $this->assertEquals('April',$salaryDateCalulation->getMonth());
    }
    
    public function testSetSalaryBase()
    {
        $salaryDateCalulation = new SalaryDateCalculations;
        $salaryDateCalulation->setSalaryBase(1496906297);
        $this->assertSame('2017 06 30', $salaryDateCalulation->getBase());
    }
    
    public function testSetSalaryBaseEndsWeekend()
    {
        $salaryDateCalulation = new SalaryDateCalculations;
        $salaryDateCalulation->setSalaryBase(1505632697);
        $this->assertSame('2017 09 29', $salaryDateCalulation->getBase());
    }
    
    public function testSetSalaryBonus()
    {
        $salaryDateCalulation = new SalaryDateCalculations;
        $salaryDateCalulation->setSalaryBonus(1505632697);
        $this->assertSame('2017 09 15', $salaryDateCalulation->getBonus());
    }
    
    public function testSetSalaryBonus15thOnWeekend()
    {
        $salaryDateCalulation = new SalaryDateCalculations;
        $salaryDateCalulation->setSalaryBonus(1501485497);
        $this->assertSame('2017 07 19', $salaryDateCalulation->getBonus());
    }
}
