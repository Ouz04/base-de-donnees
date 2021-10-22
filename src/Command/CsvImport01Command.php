<?php

namespace App\Command;

use App\Repository\TartfouRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CsvImport01Command extends Command
{
    private EntityManagerInterface $em;
    private string $dataDirectory;

    private TartfouRepository $tartfouRepository;
    private SymfonyStyle $io;
    protected static $defaultName = 'app:create-users-from-file';
    //    protected static $defaultDescription = 'Import fichier fournisseur';

    public function __construct(EntityManagerInterface $em, string $dataDirectory, TartfouRepository $tartfouRepository)
    {
        parent::__construct();
        $this->dataDirectory = $dataDirectory;
        $this->em = $em;

        $this->tartfouRepository = $tartfouRepository;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Import fichier fournisseur');
            // ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            // ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->createUpload();
        // $io = new SymfonyStyle($input, $output);
        // $arg1 = $input->getArgument('arg1');

        // if ($arg1) {
        //     $io->note(sprintf('You passed an argument: %s', $arg1));
        // }

        // if ($input->getOption('option1')) {
        //     // ...
        // }

        // $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
    private function getDataFromFile()
    {
        $file = $this->dataDirectory . 'artfouinit.csv';
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        $normalizers = [new ObjectNormalizer()];
        $encoders = [
            new CsvEncoder(),
            new XmlEncoder(),
            new YamlEncoder()
        ];

        $serializer = new Serializer($normalizers, $encoders);
        /**
         * @var string $fileString
         */
        $fileString = file_get_contents($file);
        $data = $serializer->decode($fileString, $fileExtension);
        dd($data);
    }
    private function createUpload()
    {
        $this->getDataFromFile();
    }
}
