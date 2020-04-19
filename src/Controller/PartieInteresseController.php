<?php

namespace App\Controller;
use App\Entity\AccessToken;
use App\Entity\Categoriepi;
use App\Entity\Exigencepi;
use App\Entity\HistoriquePI;
use App\Entity\Partieinteresse;
use App\Entity\User;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PartieInteresseController extends AbstractController
{


    /**
     * @Route("/partieinteresse/cat1", name="partie_interesse12")
     * methods={"GET"}
     */
    public function findbycategories(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse Partieinteresse */
        $categoriepi = $entityManager->getRepository(Categoriepi::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriepi, 'json', ["attributes" => ['id', 'nomcat', 'partieinteresses' => ['id', 'NomPI', 'Poids']]]);

        return new JsonResponse($response);

    }




    /**
     * @Route("/GetExigenceByAction", name="GetExigenceByAction")
     * methods={"GET"}
     */
    public function GetExigenceByAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse Partieinteresse */
        $partieinteresse = $entityManager->getRepository(Exigencepi::class)->findAll();
        $res = json_encode($partieinteresse);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($partieinteresse, 'json', ["attributes" => ['id', 'EtatDeConfirmite', 'Commantaire' , 'planDeActions' => ['id']]]);
        return new JsonResponse($response);
    }




    /**
     * @Route("/nbreCategories", name="nbre_categorie")
     * methods={"GET"}
     */
    public function getNbreCategorie(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse Partieinteresse */
        $categories = $entityManager->getRepository(Partieinteresse::class)->getNbreCategories();
//        $res = json_encode($partieinteresse);
//        $serializer=new Serializer([new ObjectNormalizer()]);
//        $response=$serializer->normalize($partieinteresse,'json',["attributes"=>['id','NomPI','CategoriesPI'=>['nomcat']]]);
        return new JsonResponse($categories);
    }

    /**
     * @Route("/pipertinante/{seul}", name="pipertinante")
     * methods={"GET"}
     */
    public function getPIpertinante(Request $request , $seul )
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse Partieinteresse */
        $pipertinante = $entityManager->getRepository(Partieinteresse::class)->getPIpertinante($seul);
//        $res = json_encode($partieinteresse);
//        $serializer=new Serializer([new ObjectNormalizer()]);
//        $response=$serializer->normalize($partieinteresse,'json',["attributes"=>['id','NomPI','CategoriesPI'=>['nomcat']]]);
        return new JsonResponse($pipertinante);
    }

    /**
     * @Route("/savehistorique/{seul}", name="savehistorique")
     * methods={"GET"}
     */
    public function savehistoriquePI(Request $request , $seul)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $pipertinantes = $entityManager->getRepository(Partieinteresse::class)->getPIpertinante($seul);


        if(count($pipertinantes)){
            /** @var Partieinteresse $pipertinante */
            foreach ($pipertinantes as  $pipertinante ){
                $historique = new HistoriquePI();
                $pipertinanteObj = $this->getDoctrine()->getRepository(Partieinteresse::class)->find($pipertinante['id']);
                $historique->setPoids($pipertinanteObj->getPoids());
                $historique->setNomPI($pipertinanteObj->getNomPI());
                $historique->setDate(new \DateTime());
                $entityManager->persist($historique);
                $entityManager->flush();
            }
        }
//        $res = json_encode($partieinteresse);

        return new JsonResponse('sucess');
    }


    /**
     * @Route("/getPoids/{id}", name="getPoids")
     */
    public function calculepoids(Request $request , $id): Response
    {
        if ($request->isMethod('POST')) {
            $button = $request->get('nom_champ');
            $partieinteresse = new Partieinteresse();
            if ($button === 'interet'){
                $em = $this->getDoctrine()->getManager();
                $partieinteresse = $em->getRepository(Partieinteresse::class)->findById($id);
                /* @var $partieinteresse Partieinteresse */
                $partieinteresse[0]->setInteret($request->get('interet'));
                $partieinteresse[0]->setInfluence($request->get('influence'));
                $poid= $request->get('influence') * $request->get('interet');

                dump($poid);
                $partieinteresse[0]->setPoids($poid);

                $em->persist($partieinteresse[0]);
                $em->flush();

                return new Response('true', 200);
            }

            if ($button === 'pouvoir'){
                $em = $this->getDoctrine()->getManager();
                $partieinteresse = $em->getRepository(Partieinteresse::class)->findById($id);
                /* @var $partieinteresse Partieinteresse */
                $partieinteresse[0]->setPouvoir($request->get('pouvoir'));
                $partieinteresse[0]->setInfluence($request->get('influence'));
                $poid= $request->get('influence') * $request->get('pouvoir');

                dump($poid);
                $partieinteresse[0]->setPoids($poid);

                $em->persist($partieinteresse[0]);
                $em->flush();

                return new Response('true', 200);
            }
            return new JsonResponse('ssssssss');
        }
        return new JsonResponse('false');
    }

}


