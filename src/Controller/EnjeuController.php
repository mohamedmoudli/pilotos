<?php


namespace App\Controller;


use App\Entity\CategoriesEnjeuExterne;
use App\Entity\CategoriesEnjeuInterne;
use App\Entity\Enjeu;
use App\Entity\Partieinteresse;
use App\Entity\TypeEnjeu;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class EnjeuController extends AbstractController
{

    /**
     * @Rest\Route("/CategorieByEnjeu", name="CategorieByEnjeu")
     * methods={"GET"}
     */
    public function findbycategories1(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $categoriepi = $entityManager->getRepository(CategoriesEnjeuInterne::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriepi, 'json', ["attributes" => ['id', 'NomCategories', 'enjeus' => ['id', 'Description', 'typeEnjeu'=>['id' , 'NomType']]]]);

        return new JsonResponse($response);

    }

    /**
     * @Rest\Route("/CategorieExternByEnjeu", name="CategorieExternByEnjeu")
     * methods={"GET"}
     */
    public function findbycategoriesextern(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $categoriepi = $entityManager->getRepository(CategoriesEnjeuExterne::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriepi, 'json', ["attributes" => ['id', 'NomCategorie', 'enjeus' => ['id', 'Description', 'typeEnjeu'=>['id' , 'NomType']]]]);

        return new JsonResponse($response);

    }

    /**
     * @Route("/enjeuForce/{force}", name="enjeuForce")
     * methods={"GET"}
     */
    public function getEnjeuForce(Request $request , $force)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse Partieinteresse */
        $pipertinante = $entityManager->getRepository(Enjeu::class)->getEnjeuForce($force);
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
        /* @var $partieinteresse Partieinteresse */
        $typeEnjeu = $entityManager->getRepository(TypeEnjeu::class)->findAll();
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
        /* @var $partieinteresse Partieinteresse */
        $pipertinante = $entityManager->getRepository(Enjeu::class)->getcoutType();
//        $res = json_encode($partieinteresse);
//        $serializer=new Serializer([new ObjectNormalizer()]);
//        $response=$serializer->normalize($partieinteresse,'json',["attributes"=>['id','NomPI','CategoriesPI'=>['nomcat']]]);
        return new JsonResponse($pipertinante);
    }
}