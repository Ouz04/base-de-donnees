<?php

namespace App\Command;

use DateTime;
use League\Csv\Reader;
use App\Entity\Tartfou;
use App\Entity\Tmrqice;
use App\Entity\Tarticle;
use App\Entity\Titgficett;
use App\Entity\Titgficpst;
use App\Entity\Ttypitgfic;
use App\Entity\Tfournisseur;
use App\Entity\Tconstructeur;
use App\Repository\TtypitgficRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TfournisseurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CsvImport03Command extends Command
{
    private string $dataDirectory;
    protected static $defaultName = 'csv:import_03';
    protected static $defaultDescription = 'Import fichier csv';
    private UserInterface $user;
    private $em;
    private $ttypitgficRepository;
    private $tfournisseurRepository;
    private $ttypsttRepository;
    private $tartfouRepository;
    private $ttypsttOk;
    private $ttypsttKo;
    private $tuser;
    private Ttypitgfic $ttypitgfic;
    private Titgficett $titgficett;
    private Titgficpst $titgficpst;
    /**
     * @var Tarticle
     */
    private $tarticle;
    private Tartfou $tartfouOld;
    /**
     * @var Tfournisseur
     */
    private $tfournisseur;
    /**
     * @var Tconstructeur
     */
    private $tconstructeur;
    /**
     * @var Tmrqice
     */
    private  $tmrqice;
    // variables du fichier
    private string $fouFic;
    private string $codArtFic;
    private string $lblArtFic;
    private string $eanArtFic;
    private string $deeArtFic;
    private float $prxPblFic = 0;
    private float $prxAchFic = 0;
    private float $txsArtFic = 0;
    private float $txeArtFic = 0;
    private int $stkArtFic = 0;
    private int $qteCnd = 1;

    public function __construct(EntityManagerInterface $em, string $dataDirectory)
    {
        parent::__construct();
        $this->em = $em;
        $this->dataDirectory = $dataDirectory;
        $this->ttypitgficRepository = $this->em->getRepository("App:Ttypitgfic");
        $this->tfournisseurRepository = $this->em->getRepository("App:Tfournisseur");
        $this->tconstructeurRepository = $this->em->getRepository("App:Tconstructeur");
        $this->tmrqiceRepository = $this->em->getRepository("App:Tmrqice");
        $this->tarticleRepository = $this->em->getRepository("App:Tarticle");
        $this->tartfouRepository = $this->em->getRepository("App:Tartfou");
        $this->ttypsttRepository = $this->em->getRepository("App:Ttypstt");
        $this->tartfouRepository = $this->em->getRepository("App:Tartfou");
        $this->ttypsttOk = $this->ttypsttRepository->findOneBy(['id' => 1]);
        $this->ttypsttKo = $this->ttypsttRepository->findOneBy(['id' => 2]);
        $this->tUserRepository = $this->em->getRepository("App:Tuser");
        $this->tuser = $this->tUserRepository->findOneBy(['id' => '1']);
    }
    protected function configure()
    {
        $this
            ->setname('csv:import_03')
            ->setDescription(self::$defaultDescription);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {



        $io = new SymfonyStyle($input, $output);
        $io->title("En cours d'intégration fichier");
        $filename = $this->dataDirectory . 'artfouinit.csv';

        $row = 1;
        $this->fillTitgficett($filename);

        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {

                $num = count($data);
                echo "num $num";
                if ($num === null) {
                    $num = 0;
                }
                //   echo "<p> $num champs à la ligne $row: <br /></p>\n";

                /**
                 * @var string
                 */
                $line = '';

                for ($c = 0; $c < $num; $c++) {

                    $line = $line . $data[$c] .  ';';
                    // echo "valeur " . $data[$c] . "<br />\n";
                }

                $this->fouFic = strtoupper($data[0]);
                $this->codArtFic = strtoupper($data[1]);
                $this->lblArtFic = $data[2];
                $this->eanArtFic = $data[3];
                $this->deeEArtFic = $data[4];
                $this->prxPblFic = (float)str_replace(',', '.', $data[5]);
                $this->prxAchFic = (float)str_replace(',', '.', $data[6]);
                $this->stkArtFic = (int)$data[7];
                //  $this->txsArtFic = str_replace(',', '.', $data[8]);
                //   $this->txeArtFic = str_replace(',', '.', $data[9]);

                echo "prix achat $this->prxAchFic \n";
                echo "prix taxe $this->txsArtFic \n";
                $this->qteCnd = 1;
                $this->fillTitgficpst($line, $num, $row);

                $this->findClr();

                echo "<p> fournisseur " . strtoupper($this->fouFic) . ": <br /></p>\n";
                if (!$this->tfournisseur) {
                    echo "<p> fournisseur non existant <br /></p>\n";
                    $this->titgficpst->setClrTypstt($this->ttypsttKo);
                    $this->titgficpst->setCmt('Fournisseur inexistant');
                } elseif (!$this->tarticle) {
                    echo "<p> article non existant <br /></p>\n";
                    $this->titgficpst->setClrTypstt($this->ttypsttKo);
                    $this->titgficpst->setCmt('Article inexistant');
                    echo "<p> creation article</p>\n";
                    $this->fillTarticle();
                } elseif ($this->dblArtFou($this->tfournisseur, $this->tarticle, $this->prxAchFic, $this->txsArtFic, $this->txeArtFic, $this->qteCnd) === false) {
                    echo "<p> pas de doublon</p>\n";
                    $this->titgficpst->setClrTypstt($this->ttypsttOk);
                    // on rend l'ancien tarif inactif
                    $this->tartfouOld = $this->tartfouRepository->findOneBy(['clrArt' => $this->tarticle->getId(), 'clrFou' => $this->tfournisseur->getId(), 'qteCnd' => $this->qteCnd, 'xAct' => true]);
                    if ($this->tartfouOld) {
                        // echo count($tartfouOld);
                        $this->tartfouOld->setXact(false);
                        $this->tartfouOld->setUsrUpd($this->tuser);
                        $this->tartfouOld->setDatUpd(new \DateTime('now'));
                        $this->em->persist($this->tartfouOld);
                    }
                    $this->fillTartfou();
                    // on recherche s'il y a un ancienne ligne pour la rendre inactive
                } else {
                    echo "doublon";
                    $this->titgficpst->setClrTypstt($this->ttypsttKo);
                    $this->titgficpst->setCmt('doublon');
                }
                $this->em->persist($this->titgficpst);
                $row++;
            }
            fclose($handle);

            $this->titgficett->setNbEnr($row - 1);
            $this->em->persist($this->titgficett);
            $this->em->flush();
            $io->success("L'intégration est finie");
            return Command::SUCCESS;
        }

        $io->error('Problème');
        return Command::FAILURE;
    }
    /**
     * @var bool
     */
    private function dblArtFou(Tfournisseur $tfournisseur, Tarticle $tarticle, float $prxAchFic, float $txsArtFic, float $txeArtFic, int $qteCnd): bool
    {
        $tartfou = $this->tartfouRepository->findOneBy(['clrArt' => $tarticle->getId(), 'clrFou' => $tfournisseur->getId(), 'prxAch' => $prxAchFic, 'prxTxs' => $txsArtFic, 'prxTxe' => $txeArtFic, 'qteCnd' => $qteCnd, 'xAct' => true]);
        if ($tartfou) {
            // $tartfou2->setXact(false);
            // $tartfou2->setUsrUpd($this->tuser);
            // $tartfou2->setDatUpd(new \DateTime('now'));
            return true;
        } else {
            return false;
        }
    }
    private function fillTitgficett($filename): void
    {
        $this->ttypitgfic =  $this->ttypitgficRepository->findOneBy(['cod' => 'ARTFOU']);
        $this->titgficett = new Titgficett;
        $this->titgficett->setDatIns(new \DateTime('now'));
        $this->titgficett->setNomficLcl($filename);
        $this->titgficett->setNbEnr(0);
        $this->titgficett->setClrTif($this->ttypitgfic);
        $this->em->persist($this->titgficett);
    }
    private function fillTitgficpst($line, $num, $row): void
    {
        $this->titgficpst = new Titgficpst;
        $this->titgficpst->setClritgfic($this->titgficett);
        $this->titgficpst->setEnr($line);
        $this->titgficpst->setNbCol($num);
        $this->titgficpst->setNum($row);
    }
    private function fillTartfou(): void
    {
        $this->tartfou = new Tartfou();
        $this->tartfou->setClrArt($this->tarticle);
        $this->tartfou->setClrFou($this->tfournisseur);
        $this->tartfou->setQteCnd($this->qteCnd);
        $this->tartfou->setDatPrx(new \DateTime('now'));
        $this->tartfou->setPrxAch($this->prxAchFic);
        $this->tartfou->setPrxTxs($this->txsArtFic);
        $this->tartfou->setPrxTxe((float) $this->txeArtFic);
        $this->tartfou->setPrxPbl(0);
        $this->tartfou->setQteMin(0);
        $this->tartfou->setDev('eur');
        $this->tartfou->SetCodEan($this->eanArtFic);
        $this->tartfou->SetPrt(1);
        $this->tartfou->SetQteStk(0);
        $this->tartfou->SetXAct(1);
        $this->tartfou->SetUsrIns($this->tuser);
        $this->tartfou->SetDatIns(new \DateTime('now'));
        $this->em->persist($this->tartfou);
        echo "alimentation Tartfou";
    }
    private function fillTarticle()
    {
        $this->tarticle = new Tarticle();
        $this->tarticle->setCod($this->tfournisseur->getCod() . $this->codArtFic);
        $this->tarticle->setLibCrtFr($this->lblArtFic);
        $this->tarticle->setLibLngFr($this->lblArtFic);
        $this->tarticle->setCodEan($this->eanArtFic);
        $this->tarticle->setDatDebAct(new \DateTime('now'));
        $this->tarticle->setDatfinAct(new \DateTime('99991231'));
        $this->tarticle->setRefAdx($this->tfournisseur->getCod() . $this->codArtFic);
        $this->tarticle->setRefCtr($this->codArtFic);
        $this->tarticle->setClrCtr($this->tconstructeur);
        $this->tarticle->setClrMrqice($this->tmrqice[0]);
        $this->tarticle->setXAct(1);
        $this->tarticle->SetUsrIns($this->tuser);
        $this->tarticle->SetDatIns(new \DateTime('now'));
        $this->em->persist($this->tarticle);
    }
    private function findClr(): void
    {
        // $tconstructeur = $this->tconstructeurRepository->findOneBy(['nom' => $this->fouFic]);
        $this->tconstructeur = $this->tconstructeurRepository->findOneBy(['nom' => $this->fouFic]);
        $this->tfournisseur = $this->tfournisseurRepository->findOneBy(['rso' => $this->fouFic]);
        $this->tmrqice = $this->tmrqiceRepository->findByNom($this->fouFic);
        $this->tarticle = $this->tarticleRepository->findOneBy(['refCtr' => $this->codArtFic]);
    }
}
