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
use AppBundle\Entity\SalaryDate;
use AppBundle\Entity\SalaryDateCalculations;

class SalaryDatesCommand extends Command
{
    protected function configure()
    {
        $this
        // the name of the command (the part after "app/console")
        ->setName('app:salary-dates')

        // the short description shown while running "php app/console list"
        ->setDescription('Get salary dates.')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command allows you to get salary dates.')
        ->addArgument('filename', InputArgument::REQUIRED, 'Output filename.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $salary = new SalaryDate;
        $salaryDate = new SalaryDateCalculations;
        $currentTimestamp = time()+(60*60*24*30*4);
        $salaryDate->setSalaryMonth($salary, $currentTimestamp);
        $salaryDate->setSalaryBase($salary, $currentTimestamp);
        $salaryDate->setSalaryBonus($salary, $currentTimestamp);
        $output->writeln([
            'Your filename: '.$input->getArgument('filename')
          ]);

        // outputs a message followed by a "\n"
        $output->writeln('month: '.$salary->getMonth().' salary base: '.$salary->getBase().' bonus:'.$salary->getBonus());

    }
}
