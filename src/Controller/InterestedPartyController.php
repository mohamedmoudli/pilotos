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
     * @Route("/InterestedPartyByCategory", name="InterestedPartyByCategory")
     * methods={"GET"}
     */
    public function InterestedPartyByCategory(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse IntersetedParty */
        $categoryInterestedParty = $entityManager->getRepository(CategoryeInterestedParty::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoryInterestedParty, 'json', ["attributes" => ['id', 'NameCategory', 'intersetedParties' => ['id', 'NameInterestedParty', 'Weight']]]);

        return new JsonResponse($response);

    }




    /**
     * @Route("/GetExigency", name="GetExigency")
     * methods={"GET"}
     */
    public function GetExigency(Request $request)
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
     * @Route("/CategoryNumber", name="CategoryNumber")
     * methods={"GET"}
     */
    public function getCategoryNumber(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse IntersetedParty */
        $intersetedParty = $entityManager->getRepository(IntersetedParty::class)->getCategoryNumber();
        return new JsonResponse($intersetedParty);
    }

    /**
     * @Route("/RevelantInterestedParty/{threshold}", name="RevelantInterestedParty")
     * methods={"GET"}
     */
    public function getRevelantInterestedParty(Request $request , $threshold )
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse IntersetedParty */
        $revelantInterestedParty = $entityManager->getRepository(IntersetedParty::class)->getInterestedPartyRevelant($threshold);
        return new JsonResponse($revelantInterestedParty);
    }

    /**
     * @Route("/SaveHistoricalInterestedParty/{id}", name="SaveHistoricalInterestedParty")
     * methods={"GET"}
     */
    public function SaveHistoricalInterestedParty(Request $request , $id)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $intersetedParties = $entityManager->getRepository(IntersetedParty::class)->getInterestedPartyRevelant($id);


        if(count($intersetedParties)){
            /** @var IntersetedParty $interestedparty */
            foreach ($intersetedParties as  $interestedparty ){
                $historicalIntersetedParty = new HistoricalIntersetedParty();
                $intersetedParty = $this->getDoctrine()->getRepository(IntersetedParty::class)->find($interestedparty['id']);
                $historicalIntersetedParty->setPoids($intersetedParty->getWeight());
                $historicalIntersetedParty->setNomPI($intersetedParty->getNameInterestedParty());
                $historicalIntersetedParty->setDate(new \DateTime());
                $entityManager->persist($historicalIntersetedParty);
                $entityManager->flush();
            }
        }
        return new JsonResponse('sucess');
    }


    /**
     * @Route("/getWeight/{id}", name="getWeight")
     */
    public function countweight(Request $request , $id): Response
    {
        if ($request->isMethod('POST')) {
            $button = $request->get('nom_champ');
            $interestedParty = new IntersetedParty();
            if ($button === 'interet'){
                $em = $this->getDoctrine()->getManager();
                $interestedParty = $em->getRepository(IntersetedParty::class)->findById($id);
                /* @var $partieinteresse IntersetedParty */
                $interestedParty[0]->setInterest($request->get('Interest'));
                $interestedParty[0]->setInfluence($request->get('influence'));
                $Weight = $request->get('influence') * $request->get('Interest');
                $interestedParty[0]->setWeight($Weight);

                $em->persist($interestedParty[0]);
                $em->flush();

                return new Response('true', 200);
            }

            if ($button === 'pouvoir'){
                $em = $this->getDoctrine()->getManager();
                $intersetedParty = $em->getRepository(IntersetedParty::class)->findById($id);
                /* @var $partieinteresse IntersetedParty */
                $intersetedParty[0]->setPower($request->get('Power'));
                $intersetedParty[0]->setInfluence($request->get('influence'));
                $Weight= $request->get('influence') * $request->get('Power');
                $intersetedParty[0]->setWeight($Weight);

                $em->persist($intersetedParty[0]);
                $em->flush();

                return new Response('true', 200);
            }
            return new JsonResponse('ssssssss');
        }
        return new JsonResponse('false');
    }

}


