<?php
class FonctionsMegaptera
{
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
}
