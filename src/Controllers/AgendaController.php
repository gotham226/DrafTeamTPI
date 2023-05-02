<?php

namespace drafteam\Controllers;

use drafteam\Models\AgendaModel;

session_start();

class AgendaController
{
    public function agenda()
    {
        require_once('../src/Views/agenda.php');
    }

    public function agendaEvent()
    {
        $result = AgendaModel::selectAllEvent();

        $data = array();
        foreach ($result as $row) {
            $data[] = array(
                'title' => $row['nomEvenement'],
                'start' => $row['heureDebut'],
                'end' => $row['heureFin'],
                'color' => 'purple',
                'publicId' => $row['idEvenement']
            );
        }
        //date( "Y-m-d\TH:i:s")
        echo json_encode($data);
    }
}