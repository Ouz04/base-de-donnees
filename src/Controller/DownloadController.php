<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DownloadController extends AbstractController
{
    /**
     * @Route("/download", name="download")
     */
    public function download($tab): Response
    {
        //Nom des colonnes en première lignes
        // le \n à la fin permets de faire un saut de ligne, super important en CSV
        // le point virgule sépare les données en colonnes
        $myVariableCSV = "Nom; Prenom; Age;\n";
        //Ajout de données (avec le . devant pour ajouter les données à la variable existante)
        $myVariableCSV .= "John; Doe; 26;\n";
        //Si l'on souhaite ajouter un espace
        $myVariableCSV .= " ; ; ; \n";
        //Autre donnée
        $myVariableCSV .= "Chuck; Norris; 80;\n";
        //On donne la variable en string à la response, nous définissons le code HTTP à 200
        return new Response(
            $myVariableCSV,
            200,
            [
                //Définit le contenu de la requête en tant que fichier Excel
                'Content-Type' => 'application/vnd.ms-excel',
                //On indique que le fichier sera en attachment donc ouverture de boite de téléchargement ainsi que le nom du fichier
                "Content-disposition" => "attachment; filename=Tutoriel.csv"
            ]
        );
    }
}
