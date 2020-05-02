<?php

namespace App\Controller;
use App\Entity\AccessToken;
use App\Entity\CategoryeInterestedParty;
use App\Entity\ExigencyInterestedParty;
use App\Entity\HistoricalIntersetedParty;
use App\Entity\IntersetedParty;
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


class InterestedPartyController extends AbstractController
{


    /**
     * @Route("/partieinteresse/cat1", name="partie_interesse12")
     * methods={"GET"}
     */
    public function findbycategories(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse IntersetedParty */
        $categoriepi = $entityManager->getRepository(CategoryeInterestedParty::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriepi, 'json', ["attributes" => ['id', 'NameCategory', 'intersetedParties' => ['id', 'NameInterestedParty', 'Weight']]]);

        return new JsonResponse($response);

    }




    /**
     * @Route("/GetExigencyByAction", name="GetExigencyByAction")
     * methods={"GET"}
     */
    public function GetExigencyByAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse IntersetedParty */
        $ExigencyInterestedParty = $entityManager->getRepository(ExigencyInterestedParty::class)->findAll();
        $res = json_encode($ExigencyInterestedParty);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($ExigencyInterestedParty, 'json', ["attributes" => ['id', 'StateOfConfirmity', 'Comment' , 'planDeActions' => ['id']]]);
        return new JsonResponse($response);
    }




    /**
     * @Route("/nbreCategories", name="nbre_categorie")
     * methods={"GET"}
     */
    public function getNbreCategory(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse IntersetedParty */
        $intersetedParty = $entityManager->getRepository(IntersetedParty::class)->getNbreCategory();
//        $res = json_encode($partieinteresse);
//        $serializer=new Serializer([new ObjectNormalizer()]);
//        $response=$serializer->normalize($partieinteresse,'json',["attributes"=>['id','NomPI','CategoriesPI'=>['nomcat']]]);
        return new JsonResponse($intersetedParty);
    }

    /**
     * @Route("/pipertinante/{threshold}", name="pipertinante")
     * methods={"GET"}
     */
    public function getPIpertinante(Request $request , $threshold )
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse IntersetedParty */
        $pipertinante = $entityManager->getRepository(IntersetedParty::class)->getPIpertinante($threshold);
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

        $pipertinantes = $entityManager->getRepository(IntersetedParty::class)->getPIpertinante($seul);


        if(count($pipertinantes)){
            /** @var IntersetedParty $pipertinante */
            foreach ($pipertinantes as  $pipertinante ){
                $historique = new HistoricalIntersetedParty();
                $pipertinanteObj = $this->getDoctrine()->getRepository(IntersetedParty::class)->find($pipertinante['id']);
                $historique->setPoids($pipertinanteObj->getPower());
                $historique->setNomPI($pipertinanteObj->getNameInterestedParty());
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
            $partieinteresse = new IntersetedParty();
            if ($button === 'interet'){
                $em = $this->getDoctrine()->getManager();
                $partieinteresse = $em->getRepository(IntersetedParty::class)->findById($id);
                /* @var $partieinteresse IntersetedParty */
                $partieinteresse[0]->setInterest($request->get('Interest'));
                $partieinteresse[0]->setInfluence($request->get('influence'));
                $poid= $request->get('influence') * $request->get('Interest');

                dump($poid);
                $partieinteresse[0]->setWeight($poid);

                $em->persist($partieinteresse[0]);
                $em->flush();

                return new Response('true', 200);
            }

            if ($button === 'pouvoir'){
                $em = $this->getDoctrine()->getManager();
                $intersetedParty = $em->getRepository(IntersetedParty::class)->findById($id);
                /* @var $partieinteresse IntersetedParty */
                $intersetedParty[0]->setPower($request->get('Power'));
                $intersetedParty[0]->setInfluence($request->get('influence'));
                $load= $request->get('influence') * $request->get('Power');

                dump($load);
                $intersetedParty[0]->setWeight($load);

                $em->persist($intersetedParty[0]);
                $em->flush();

                return new Response('true', 200);
            }
            return new JsonResponse('ssssssss');
        }
        return new JsonResponse('false');
    }

}


