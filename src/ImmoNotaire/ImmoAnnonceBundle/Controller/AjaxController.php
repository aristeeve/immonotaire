<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends Controller {

    public function uploadMediaAction(Request $request, $media) {

        $em = $this->getDoctrine()->getManager();
        $param = explode(" ", $media);

        $annonce = $em->getRepository("ImmoAnnonceBundle:Annonce")->find($param[5]);

    
            $annonce->getMedia()->setFile($param[0]);
  
            $annonce->getMedia()->setFile1($param[1]);
    
            $annonce->getMedia()->setFile2($param[2]);
   
            $annonce->getMedia()->setFile3($param[3]);

            $annonce->getMedia()->setFile4($param[4]);
    


        $em->flush();

        $response = new JsonResponse();
        return $response->setData(array(
                    'file' => $annonce->getMedia()->getFile(),
                    'file1' => $annonce->getMedia()->getFile1(),
                    'file2' => $annonce->getMedia()->getFile2(),
                    'file3' => $annonce->getMedia()->getFile3(),
                    'file4' => $annonce->getMedia()->getFile4(),
        ));
    }

    public function rechercheVilleAction(Request $request, $Region) {

        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $villes = $em->getRepository('ImmoAnnonceBundle:Villes')->findBy(array('regions' => $Region));
            if ($villes) {
                $totaleVilles = array();
                foreach ($villes as $uniqVille) {
                    $totaleVilles[$uniqVille->getId()] = $uniqVille->getNom();
                }
            } else {
                $totaleVilles = null;
            }
            // var_dump($totaleVilles);
            $response = new JsonResponse();
            return $response->setData(array('ville' => $totaleVilles));
        } else {
            throw new \Exception('Erreur');
        }
    }

    public function listeVilleAction() {

        $em = $this->getDoctrine()->getManager();
        $villes = $em->getRepository('ImmoAnnonceBundle:Villes')->findAll();

        $response = new JsonResponse();
        return $response->setData(array('ville' => $villes));
    }

    public function rechercheModeleAction(Request $request, $TypeBien) {
        
    }

    function donneeModele($repository) {
        $em = $this->getDoctrine()->getManager();
        $modeles = $em->getRepository('ImmoAnnonceBundle:' . $repository)->findAll();
        $modelesTab = $this->trie($modeles);
        $response = new JsonResponse();
        return $response->setData(array('data' => $modelesTab));
    }

    function getVilles($repository) {
        $em = $this->getDoctrine()->getManager();
        $villes = $em->getRepository('ImmoAnnonceBundle:' . $repository)->findAll();

        $response = new JsonResponse();
        return $response->setData(array('ville' => $villes));
    }

    function trie($modeles = array()) {
        if ($modeles) {
            $modelesTab = array();
            foreach ($modeles as $modele) {
                $modelesTab[$modele->getId()] = $modele->getNom();
            }
        } else {
            $modelesTab = null;
        }
        return $modelesTab;
    }

}
