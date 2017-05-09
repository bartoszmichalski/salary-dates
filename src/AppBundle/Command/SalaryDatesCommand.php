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
        ->setDescription('Get CSV file with salary dates.')
        ->setHelp('This command allows you to get salary dates till end of current year.')
        ->addArgument('filename', InputArgument::REQUIRED, 'Output file name.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $directory = 'web/output';
        $filename = $input->getArgument('filename');
        $handler = fopen($directory.'/'.$filename.'.csv', 'w');         
        $currentTimestamp = time();
        $currentMonth = (date('n', $currentTimestamp));        
        for ($i = $currentMonth; $i <= 12; $i++) {
            $TimestampForIterator = strtotime('+'.$i - $currentMonth.'months',$currentTimestamp);
            $salaryDateCalc = new SalaryDateCalculations;
            $salaryDateCalc
                ->setSalaryMonth( $TimestampForIterator)
                ->setSalaryBase( $TimestampForIterator)
                ->setSalaryBonus( $TimestampForIterator);          
            fputcsv($handler, array($salaryDateCalc->getMonth(), $salaryDateCalc->getBase(), $salaryDateCalc->getBonus()));
        }
        fclose($handler);
        $output->writeln([
                'File ('.$directory.'/'.$filename.'.csv) has been saved.'
              ]);
    }
}
