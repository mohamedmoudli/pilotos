<?php


namespace App\Controller;


use App\Entity\CategoryRisk;
use App\Entity\CategoryStakeInternal;
use App\Entity\StateOpportunity;
use App\Entity\StateRisk;
use App\Entity\ExigencyInterestedParty;
use App\Entity\HistoricalIntersetedParty;
use App\Entity\HistoricalRisk;
use App\Entity\IntersetedParty;
use App\Entity\ActionPlan;
use App\Entity\Process;
use App\Entity\Risk;
use App\Entity\StrategicRisk;
use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class RiskControlleur extends AbstractController
{

    /**
     * @Route("/saveRisk", name="getRisque")
     */
    public function createRisque(Request $request): Response
    {
        // success

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $risque = new Risk();


            $risque->setDescription($request->request->get('Description'));
            $risque->setShortTerm($request->request->get('ShortTerm'));
            $risque->setMediumTerm($request->request->get('MediumTerm'));
            $risque->setLongTerm($request->request->get('LongTerm'));
            $risque->setDateIdentification($request->request->get('DateIdentification'));
            $risque->setCauses($request->request->get('Causes'));
            $risque->setCensequence($request->request->get('Censequence'));
            $risque->setGravity($request->request->get('Gravity'));
            $risque->setProbability($request->request->get('Probability'));
            $risque->setDetectability($request->request->get('Detectability'));
            $Criticality = $request->request->get('Gravity') * $request->request->get('Probability') * $request->request->get('Detectability');
            $risque->setCriticality($Criticality);
            if($Criticality < 16 ){
                $risque->setDecision('Ok');
            }
            if( 16 <= $Criticality ){
                if(32 > $Criticality){
                    $risque->setDecision('Attention !!');
                }
            }
            if($Criticality > 32 ){
                $risque->setDecision('stop');
            }
            $idStrategic = $request->get('idstrategic');
            $idprocess = $request->get('idprocess');
            $idcategory = $request->get('idcategory');
            $idstateRisk = $request->get('idStateRisk');
            dump($idStrategic);
            $res = intval($idStrategic);
            dump($res);
            $res1 = intval($idprocess);
            dump($res1);
            $res2 = intval($idcategory);
            $strategicrisk = $em->getRepository(StrategicRisk::class)->findOneById($res);
            dump($strategicrisk);

            $risque->setStrategicRisk($strategicrisk);
            $processRisk = $em->getRepository(Process::class)->findOneById($res1);
            $risque->setProcess($processRisk);
            $CategoriyRisk = $em->getRepository(CategoryRisk::class)->findOneById($res2);
            $risque->setCategoryRisk($CategoriyRisk);
            $stateRisk = $em->getRepository(StateRisk::class)->findOneById($idstateRisk);
            $risque->setStateRisk($stateRisk);
            $risque->setComment($request->request->get('Comment'));


            $em->persist($risque);

            $em->flush();
            return new JsonResponse('success');
        }

        return new JsonResponse('error1');
    }

    /**
     * @Route("/savehistoricalRisk", name="savehistoricalRisk")
     * methods={"GET"}
     */
    public function savehistoriqueRisque(Request $request )
    {

        $entityManager = $this->getDoctrine()->getManager();

        $pipertinantes = $entityManager->getRepository(Risk::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($pipertinantes, 'json', ["attributes" => ['id' ,'Description' ,'ShortTerm' , 'MediumTerm' ,'LongTerm' , 'Causes' , 'Censequence' ,'Gravity' , 'Probability' , 'detectability' , 'Criticality' , 'Decision' , 'StateRisk' , 'Comment' , 'Process'  , 'StrategicRisk' , 'planDeActions'=> ['id' , 'Origin']]]);

        if(count($response)){
            /** @var IntersetedParty $pipertinante */
            foreach ($response as  $pipertinante ){
                $historique = new HistoricalRisk();
                $pipertinanteObj = $this->getDoctrine()->getRepository(Risk::class)->find($pipertinante['id']);
                $strategic = new StrategicRisk();
                $strategic = $pipertinanteObj->getStrategicRisk();
                $processlie = new Process();
                $processlie = $pipertinanteObj->getProcess();
                $StateRisk = new StateRisk();
                $StateRisk = $pipertinanteObj->getStateRisk();
                $numActions = new ActionPlan();
                $numActions = $pipertinanteObj->getactionPlans();
                foreach ($numActions as  $numAction ){
                    $historique->addNumeroAction($numAction);
                }
                $historique->setCriticite($pipertinanteObj->getCriticality());

                $historique->setDecision($pipertinanteObj->getDecision());



                $historique->setStrategique($strategic->getNameStrategicRisk());
                $historique->setEtatRisque($StateRisk->getNameStateRisk());
                $historique->setProcesslie($processlie->getProcess());

                $historique->setCommentaires($pipertinanteObj->getComment());
                $historique->setDate(new \DateTime());
                $entityManager->persist($historique);
                $entityManager->flush();
            }
        }
//        $res = json_encode($partieinteresse);

        return new JsonResponse('sucess');
    }




    /**
     * @Route("/getRisk", name="getRisk")
     * methods={"GET"}
     */
    public function GetRisqueByAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(Risk::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriesrisque, 'json', ["attributes" => ['id' ,'Description' ,'ShortTerm' , 'MediumTerm' ,'LongTerm' , 'DateIdentification' ,  'Causes' , 'Censequence' ,'Gravity' , 'Probability' , 'detectability' , 'Criticality' , 'Decision' , 'StateRisk' , 'Comment' , 'CategoryRisk' ,'Process'  , 'StrategicRisk' , 'actionPlans'=> ['id' , 'Origine']]]);
        return new JsonResponse($response);
    }


    /**
     * @Route("/GetByAction", name="GetbyRisque")
     * methods={"GET"}
     */
    public function GetRisque(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(Risk::class)->findAll();
        dump($categoriesrisque);

        return new JsonResponse($categoriesrisque);
    }

    /**
     * @Route("/gethistoricalRisk", name="gethistoricalRisk")
     * methods={"GET"}
     */
    public function GethistoriqueRisque(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(HistoricalRisk::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriesrisque, 'json', ["attributes" => ['id' ,  'Criticite' , 'Decision' , 'StateRisk' ,
            'Commentaires' ,  'Processlie'  , 'Strategique' ,'Date' , 'NumeroAction'=> ['id' , 'Origine']]]);
        return new JsonResponse($response);
    }



    /**
     * @Route("/GetNbreEtatRisque", name="GetNbreEtatRisque")
     * methods={"GET"}
     */
    public function GetNbreEtatRisque(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(Risk::class)->getNbreStateRisk();


        return new JsonResponse($categoriesrisque);
    }


    /**
     * @Route("/GetNbreCategorieRisque", name="GetNbreCategorieRisque")
     * methods={"GET"}
     */
    public function GetNbreCategorieRisque(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(Risk::class)->getNbreCategoryRisk();


        return new JsonResponse($categoriesrisque);
    }

}
