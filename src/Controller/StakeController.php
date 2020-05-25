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
    public function CategoryInternalByStake(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $categoryStakeInternal = $entityManager->getRepository(CategoryStakeInternal::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoryStakeInternal, 'json', ["attributes" => ['id', 'NameCategoryStakInternal', 'stakes' => ['id', 'Description', 'Type']]]);

        return new JsonResponse($response);

    }

    /**
     * @Rest\Route("/GetCategoryExternalByStake", name="GetCategoryExternalByStake")
     * methods={"GET"}
     */
    public function GetCategoryExternalByStake(Request $request)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $categoryStakeExternal = $entityManager->getRepository(CategoryStakeExternal::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoryStakeExternal, 'json', ["attributes" => ['id', 'NameCategoryStakExternal', 'stakes' => ['id', 'Description', 'Type']]]);

        return new JsonResponse($response);

    }

    /**
     * @Route("/TypeCount", name="TypeCount")
     * methods={"GET"}
     */
    public function getTypeCount(Request $request )
    {
        $entityManager = $this->getDoctrine()->getManager();
        /* @var $partieinteresse IntersetedParty */
        $stakeTypeCount = $entityManager->getRepository(Stake::class)->getcoutType();
        return new JsonResponse($stakeTypeCount);
    }
}