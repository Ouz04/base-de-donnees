<?php

namespace App\Service;

use DateTime;
use League\Csv\Reader;
use App\Entity\Tartfou;
use App\Entity\Tmrqice;
use App\Entity\Tarticle;
use App\SpecClass\ItgRtr;
use App\Entity\Titgficett;
use App\Entity\Titgficpst;
use App\Entity\Ttypitgfic;
use App\Entity\Tfournisseur;
use App\Entity\Tconstructeur;
use App\Repository\TtypitgficRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class ItgArtfou
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
    /**
     * @var Tartfou
     */
    private $tartfouOld;
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
    private int $idc = 0;
    public function __construct(EntityManagerInterface $em)
    {

        $this->em = $em;
        //   $this->dataDirectory = $dataDirectory;
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
        $this->tuserRepository = $this->em->getRepository("App:Tuser");
        $this->tuser = $this->tuserRepository->findOneBy(['id' => '1']);
        $this->tdictabRepository = $this->em->getRepository("App:Tdictab");
        $this->tdictab = $this->em->getRepository("App:Tdictab")->findOneBy(['tabnam' => 'tartfou']);
    }
    public function itgExe($ficLcl, $ficItn, $tuser, $handle): ItgRtr
    {
        date_default_timezone_set('Europe/Paris');
        $itgRtr = new ItgRtr();
        $row = 1;
        $this->fillTitgficett($ficLcl, $ficItn, $tuser);

        //   if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {

            $num = count($data);
            // echo "num $num";
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

            $this->qteCnd = 1;
            $this->fillTitgficpst($line, $num, $row);

            $this->findClr();
            // initialisation
            $this->idc = 0;

            if (!$this->tfournisseur) {

                $this->titgficpst->setClrTypstt($this->ttypsttKo);
                $this->titgficpst->setCmt('Fournisseur inexistant');
                $itgRtr->addKO();
            } elseif (!$this->tarticle) {

                $this->titgficpst->setClrTypstt($this->ttypsttKo);
                $this->titgficpst->setCmt('Article inexistant->création');
                $itgRtr->addKO();
                // $this->fillTarticle($tuser);
                // $this->titgficpst->setTbc('tarticle');
                // $this->titgficpst->setIdc($this->idc);
            } elseif ($this->dblArtFou($this->tfournisseur, $this->tarticle, $this->prxAchFic, $this->txsArtFic, $this->txeArtFic, $this->qteCnd) === false) {

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
                $this->fillTartfou($tuser);
                $this->titgficpst->setTbc('tartfou');
                $this->titgficpst->setIdc($this->idc);
                $this->titgficpst->setClrTab($this->tdictab);
                $itgRtr->addOK();
                // on recherche s'il y a un ancienne ligne pour la rendre inactive
            } else {

                $this->titgficpst->setClrTypstt($this->ttypsttKo);
                $this->titgficpst->setCmt('doublon');
                $this->titgficpst->setTbc('tartfou');
                $this->titgficpst->setIdc($this->idc);
                $this->titgficpst->setClrTab($this->tdictab);
                $itgRtr->addKO();
            }
            $this->em->persist($this->titgficpst);
            $row++;
        }
        //   fclose($handle);

        $this->titgficett->setNbEnr($row - 1);
        $this->em->persist($this->titgficett);
        $this->em->flush();

        $itgRtr->setId($this->titgficett->getId());
        return $itgRtr;
        //  }
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
            $this->idc = $tartfou->getId();
            return true;
        } else {
            return false;
        }
    }
    private function fillTitgficett($ficLcl, $ficItn, $tuser): void
    {
        $this->ttypitgfic =  $this->ttypitgficRepository->findOneBy(['cod' => 'ARTFOU']);
        $this->titgficett = new Titgficett;
        $this->titgficett->setDatIns(new \DateTime('now'));
        $this->titgficett->setUsrIns($tuser);
        $this->titgficett->setNomficLcl($ficLcl);
        $this->titgficett->setNomficItn($ficItn);
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
    private function fillTartfou($tuser): void
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
        $this->tartfou->SetUsrIns($tuser);
        $this->tartfou->SetDatIns(new \DateTime('now'));
        $this->em->persist($this->tartfou);
        // on met en mémoire id
        $this->idc = $this->tartfou->getId();
    }
    private function fillTarticle($tuser)
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
        $this->tarticle->SetUsrIns($tuser);
        $this->tarticle->SetDatIns(new \DateTime('now'));
        $this->em->persist($this->tarticle);
        $this->idc = $this->tarticle->getId();
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
