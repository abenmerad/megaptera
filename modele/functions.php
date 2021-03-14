<?php
class FonctionsMegaptera
{
    public function trierPhoto()
    {
        $pdo        =   PdoMegaptera::getPdoMegaptera();

        foreach(scandir('img/images', 1) as $dir)
        {
            $filename   = $this->cleanFilename(pathinfo($dir)['filename']);
            $basename   = $filename . '.' . pathinfo($dir)['extension'];
            $lieu       = $this -> getLieu($filename);
            $from       = "img/images/" . $basename;
            $to         = "images/" . $lieu . "/" . $basename;

            if(!empty($pdo -> getObservationParNomPhoto($filename)))
            {
                switch($this->deplacerFichier($from, $to))
                {
                    case 1:
                    {
                        echo "Ok <br>";
                        break;
                    }
                    case -1:
                    {
                        echo "fichier source non-trouvé <br>";
                        break;
                    }
                    case -2:
                    {
                        echo "copie non faite <br>";
                        break;
                    }
                    case -3:
                    {
                        echo "effacement de l'ancien fichier non effectué <br>";
                        break;
                    }
                }
            }
        }
    }

    function getLieu($filename)
    {
        $filenameArr    = str_split($filename);
        $lieu           = "";
        $index          = 0;
        while(preg_match("#[a-zA-Z]#", $filenameArr[$index], $matches) && $index < count($filenameArr))
        {
            $lieu .= strtoupper($filenameArr[$index]);
            $index++;
        }
        return substr($lieu, 0, 3);
    }
    function deplacerFichier($dossierSource, $dossierDestination) : int
    {
        $retour = 1;
        if(!file_exists($dossierSource)) {
            $retour = -1;
        }
        else
        {
            if(!copy($dossierSource, $dossierDestination))
            {
                $retour = -2;
            } else
            {
                if(!unlink($dossierSource))
                {
                    $retour = -3;
                }
            }
        }
        return($retour);
    }

    public function cleanFilename($filename) : string
    {
        $filenameArr    = str_split($filename);
        $newFilename    = "";

        foreach($filenameArr as $fl)
        {
            if($fl != '.' && $fl != "_")
            {
                $newFilename .= $fl;
            }
        }
        $newFilenameArr   = str_split($newFilename);
        if($newFilenameArr[0] == " ")
        {
            unset($newFilenameArr[0]);
            array_values(str_split($newFilename));
        }
        return $newFilename;
    }
    public function creationCSV($lesObs, $lesKeys)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=observation_export_' . date("dmYhis", time()) . '.csv');
        ob_end_clean();
        $export = fopen('php://output', 'w');

        fputcsv($export, $lesKeys, ";");

        foreach($lesObs as $uneObservation)
        {
            fputcsv($export, $uneObservation, ";");
        }
        fclose($export);
        die();
    }

    public function ecrireFichierServeur($tableau, $repertoire)
    {
        $texte = "";

        foreach($tableau as $key => $req)
        {
            if($key != 'uc' && $key != 'action')
            {
                $texte .= $key . "=>" . $req . "\r";
            }
        }
        file_put_contents($repertoire, $texte);
    }

    public function lireFichierServeur($f) : array
    {
        $data = [];
        if($f)
        {
            while (($buffer = fgets($f, 4096)) !== false) {
                $data[explode("=>", $buffer)[0]] = implode(array_slice(str_split(explode("=>", $buffer)[1]), 0, strlen(explode("=>", $buffer)[1]) - 1));
            }
            if (!feof($f)) {
                echo "Erreur: fgets() a échoué\n";
            }
            fclose($f);
        }
        return $data;
    }

    public function getID() : string
    {
        $id = null;
        if(isset($_SESSION['id']))
            $id = $_SESSION['id'];
        return $id;
    }
}
