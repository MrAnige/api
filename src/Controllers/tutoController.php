<?php

namespace tutoAPI\Controllers;

use DateTime;
use tutoAPI\Models\TutoManager;
use tutoAPI\Models\Tuto;
use tutoAPI\Controllers\abstractController;

class tutoController extends abstractController
{

    public function show($id)
    {

        // Données issues du Modèle

        $manager = new TutoManager();

        $tuto = $manager->find($id);

        // Template issu de la Vue



        return $this->jsonResponse($tuto, 200);
    }

    public function index()
    {

        $tutos = [];

        $manager = new TutoManager();

        $tutos = $manager->findAll();

        return $this->jsonResponse($tutos, 200);
    }

    public function add()
    {

        // Ajout d'un tuto
        //parse_str(file_get_contents('php://input'), $_POST);
        $tuto = new Tuto();
        $tuto->setTitle($_POST['title']);
        $tuto->setDescription($_POST['description']);
        $now=new DateTime();
        $dateString=date('Y-m-d',$now->getTimestamp());
        $tuto->setCreatedAt($dateString);
        $manager= new TutoManager();
        $tuto=$manager->add($tuto);

        // TODO: ajout d'un tuto

        return $this->jsonResponse($tuto, 200);
    }
    public function patch($id)

    {
        $manager = new TutoManager();
        $tuto = $manager->find($id);
        parse_str(file_get_contents('php://input'), $_PATCH);
        foreach($_PATCH as $key=>$value){
            if ($key=='title'){
                $tuto->setTitle($_PATCH['title']);
            }
            if ($key=='description'){
                $tuto->setDescription($_PATCH['description']);
            }
        }

        $tuto = $manager->update($tuto);
        return $this->jsonResponse($tuto, 200);
        die();
    }

    public function supp($id){
        
        $manager = new TutoManager();
        $tuto = $manager->find($id);
        $manager->delete($tuto);
        return $this->jsonResponse($tuto, 200);
        die();
    }

}
