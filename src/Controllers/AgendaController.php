<?php

namespace drafteam\Controllers;

use drafteam\Models\AgendaModel;

session_start();

class AgendaController
{
    public function agenda()
    {
        if(!isset($_SESSION['email'])){
            header('Location: /');
        }
        require_once('../src/Views/agenda.php');
    }

    public function agendaEvent()
    {
        $result = AgendaModel::selectAllEvent();

        $data = array();
        foreach ($result as $row) {
            $color = "";

            switch ($row['idType']) {
                case 1:
                    $color = "purple";
                    break;
                case 2:
                    $color = "yellow";
                    break;
                case 3:
                    $color = "blue";
                    break;
            }

            $data[] = array(
                'title' => $row['nomEvenement'],
                'start' => $row['heureDebut'],
                'end' => $row['heureFin'],
                'color' => $color,
                'publicId' => $row['idEvenement']
            );
        }
        //date( "Y-m-d\TH:i:s")
        echo json_encode($data);
    }
}