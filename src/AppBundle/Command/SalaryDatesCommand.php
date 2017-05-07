<?php

/**
 * Description of Salary
 *
 * @author bartosz
 */

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Entity\SalaryDateCalculations;

class SalaryDatesCommand extends Command
{
    protected function configure()
    {
        $this
        ->setName('app:salary-dates')
        ->setDescription('Get salary dates.')
        ->setHelp('This command allows you to get salary dates till end of current year.')
        ->addArgument('filename', InputArgument::REQUIRED, 'Output filename.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $handler = fopen('web/output/'.$input->getArgument('filename').'.csv', 'w');         
        $currentTimestamp = time();
        $currentMonth = (date('n', $currentTimestamp));        
        for ($i = $currentMonth; $i <= 12; $i++) {
            $iteratorTimestamp = strtotime('+'.$i - $currentMonth.'months',$currentTimestamp);
            $salaryDateCalc = new SalaryDateCalculations;
            $salaryDateCalc->setSalaryMonth( $iteratorTimestamp)->setSalaryBase( $iteratorTimestamp)->setSalaryBonus( $iteratorTimestamp);          
            $output->writeln('month: '.$salaryDateCalc->getMonth().' salary base: '.$salaryDateCalc->getBase().' bonus:'.$salaryDateCalc->getBonus());
            fputcsv($handler, array($salaryDateCalc->getMonth(), $salaryDateCalc->getBase(), $salaryDateCalc->getBonus()));
        }
        fclose($handler);
        $output->writeln([
                'File ('.$input->getArgument('filename').'.csv) has been saved.'
              ]);
    }
}
