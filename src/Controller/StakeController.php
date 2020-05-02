<?php


namespace App\Controller;


use App\Entity\CategoryStakeExternal;
use App\Entity\CategoryStakeInternal;
use App\Entity\Stake;
use App\Entity\IntersetedParty;
use App\Entity\TypeStake;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class StakeController extends AbstractController
{

    /**
     * @Rest\Route("/GetCategoryInternalByStake", name="GetCategoryInternalByStake")
     * methods={"GET"}
     */
    public function findbycategories1(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $categoriepi = $entityManager->getRepository(CategoryStakeInternal::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriepi, 'json', ["attributes" => ['id', 'NameCategoryStakInternal', 'stakes' => ['id', 'Description', 'Type']]]);

        return new JsonResponse($response);

    }

    /**
     * @Rest\Route("/GetCategoryExternalByStake", name="GetCategoryExternalByStake")
     * methods={"GET"}
     */
    public function GetCategoryExternalByStake(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $categoriepi = $entityManager->getRepository(CategoryStakeExternal::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriepi, 'json', ["attributes" => ['id', 'NameCategoryStakExternal', 'stakes' => ['id', 'Description', 'Type'=>['id']]]]);

        return new JsonResponse($response);

    }

    /**
     * @Route("/enjeuForce/{force}", name="enjeuForce")
     * methods={"GET"}
     */
    public function getEnjeuForce(Request $request , $force)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse IntersetedParty */
        $pipertinante = $entityManager->getRepository(Stake::class)->getEnjeuForce($force);
//        $res = json_encode($partieinteresse);
//        $serializer=new Serializer([new ObjectNormalizer()]);
//        $response=$serializer->normalize($partieinteresse,'json',["attributes"=>['id','NomPI','CategoriesPI'=>['nomcat']]]);
        return new JsonResponse($pipertinante);
    }


    /**
     * @Route("/typebycategoriesbyenjeu", name="typebycategoriesbyenjeu")
     * methods={"GET"}
     */
    public function getEnjeuForce111(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse IntersetedParty */
        $typeEnjeu = $entityManager->getRepository(TypeStake::class)->findAll();
        $serializer=new Serializer([new ObjectNormalizer()]);
        $response=$serializer->normalize($typeEnjeu,'json',["attributes"=>['id','NomType','categoriesEnjeuInternes'=>['id','NomCategories' , 'enjeus'=>['id' , 'Description']]]]);
        return new JsonResponse($response);
    }

    /**
     * @Route("/nembreType", name="nembreType")
     * methods={"GET"}
     */
    public function getnbreType(Request $request )
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse IntersetedParty */
        $pipertinante = $entityManager->getRepository(Stake::class)->getcoutType();
//        $res = json_encode($partieinteresse);
//        $serializer=new Serializer([new ObjectNormalizer()]);
//        $response=$serializer->normalize($partieinteresse,'json',["attributes"=>['id','NomPI','CategoriesPI'=>['nomcat']]]);
        return new JsonResponse($pipertinante);
    }
}