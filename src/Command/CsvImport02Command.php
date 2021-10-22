<?php

namespace App\Command;

use League\Csv\Reader;
use App\Entity\Titgficett;
use App\Entity\Tuploadett;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CsvImport02Command extends Command
{
    private string $dataDirectory;
    protected static $defaultName = 'csv:import_02';
    protected static $defaultDescription = 'Import fichier csv';
    private UserInterface $user;
    private $em;

    public function __construct(EntityManagerInterface $em, string $dataDirectory)
    {
        parent::__construct();
        $this->em = $em;
        $this->dataDirectory = $dataDirectory;
    }
    protected function configure()
    {
        $this
            ->setname('csv:import_02')
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }
        $func = function ($row) {
            return array_map('strtoupper', $row);
        };
        $io = new SymfonyStyle($input, $output);
        $io->title("En cous d'intégration fichier");
        $filename = $this->dataDirectory . 'artfouinit.csv';

        $reader = Reader::createFromPath($filename);


        $reader->setHeaderOffset(0);

        $header = $reader->getHeader();

        $records = $reader->fetchPairs(1);

        foreach ($records as $row) {
            $tupload = new Titgficett;
            $tupload->setDatIns(new \DateTime('now'));
            $tupload->setNomFicLcl($filename);

            $this->em->persist($tupload);
        }

        $this->em->flush();

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
