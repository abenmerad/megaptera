<?php
class FonctionsMegaptera
{
    private static $funct = null;

    private function __construct()
    {
    }
    private function __destruction()
    {
    }

    public static function GetFunct()
    {
        if(FonctionsMegaptera::$funct == null)
        {
            FonctionsMegaptera::$funct = new FonctionsMegaptera();
        }
        return FonctionsMegaptera::$funct;
    }


    public function creationCSV($lesObs, $lesKeys)
    {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=observation_export_' . date("dmYhis", time()) . '.csv');
        ob_end_clean();
        $export = fopen('php://output', 'w');
        $keys = [];

        foreach ($lesKeys as $k => $key) {
            $keys[] = $k;
        }
        fputcsv($export, $keys, ";");

        foreach($lesObs as $uneObservation)
        {
            fputcsv($export, $uneObservation, ";");
        }
        fclose($export);
        die();
    }
}
