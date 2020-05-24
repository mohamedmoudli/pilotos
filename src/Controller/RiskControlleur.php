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
     * @Route("/createRisk", name="createRisk")
     */
    public function createRisk(Request $request): Response
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

            $strategicrisk = $em->getRepository(StrategicRisk::class)->findOneById($idStrategic);
            dump($strategicrisk);

            $risque->setStrategicRisk($strategicrisk);
            $processRisk = $em->getRepository(Process::class)->findOneById($idprocess);
            $risque->setProcess($processRisk);
            $CategoriyRisk = $em->getRepository(CategoryRisk::class)->findOneById($idcategory);
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
    public function savehistoricalRisk(Request $request )
    {

        $entityManager = $this->getDoctrine()->getManager();

        $pipertinantes = $entityManager->getRepository(Risk::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($pipertinantes, 'json', ["attributes" => ['id' ,'Description' ,'ShortTerm' , 'MediumTerm' ,'LongTerm' , 'Causes' , 'Censequence' ,'Gravity' , 'Probability' , 'detectability' , 'Criticality' , 'Decision' , 'StateRisk' , 'Comment' , 'Process'  , 'StrategicRisk' , 'planDeActions'=> ['id' , 'Origin']]]);

        if(count($response)){
            /** @var IntersetedParty $pipertinante */
            foreach ($response as  $histricalrisk ){
                $historicalRisk = new HistoricalRisk();
                $risk = $this->getDoctrine()->getRepository(Risk::class)->find($histricalrisk['id']);
                $strategic = new StrategicRisk();
                $strategic = $risk->getStrategicRisk();
                $processlie = new Process();
                $processlie = $risk->getProcess();
                $StateRisk = new StateRisk();
                $StateRisk = $risk->getStateRisk();
                $numActions = new ActionPlan();
                $numActions = $risk->getactionPlans();
                foreach ($numActions as  $numAction ){
                    $historicalRisk->addNumeroAction($numAction);
                }
                $historicalRisk->setCriticite($risk->getCriticality());

                $historicalRisk->setDecision($risk->getDecision());



                $historicalRisk->setStrategique($strategic->getNameStrategicRisk());
                $historicalRisk->setEtatRisque($StateRisk->getNameStateRisk());
                $historicalRisk->setProcesslie($processlie->getProcess());

                $historicalRisk->setCommentaires($risk->getComment());
                $historicalRisk->setDate(new \DateTime());
                $entityManager->persist($historicalRisk);
                $entityManager->flush();
            }
        }
//        $res = json_encode($partieinteresse);

        return new JsonResponse('sucess');
    }




    /**
     * @Route("/GetRisk", name="GetRisk")
     * methods={"GET"}
     */
    public function GetRisk(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $risk = $entityManager->getRepository(Risk::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($risk, 'json', ["attributes" => ['id' ,'Description' ,'ShortTerm' , 'MediumTerm' ,'LongTerm' , 'DateIdentification' ,  'Causes' , 'Censequence' ,'Gravity' , 'Probability' , 'detectability' , 'Criticality' , 'Decision' , 'StateRisk' , 'Comment' , 'CategoryRisk' ,'Process'  , 'StrategicRisk' , 'actionPlans'=> ['id' , 'Origine']]]);
        return new JsonResponse($response);
    }


    /**
     * @Route("/GetRiskbyaction", name="GetbyRisquebyaction")
     * methods={"GET"}
     */
    public function GetRiskbyaction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoryrisk = $entityManager->getRepository(Risk::class)->findAll();
        dump($categoryrisk);

        return new JsonResponse($categoryrisk);
    }

    /**
     * @Route("/GethistoricalRisk", name="GethistoricalRisk")
     * methods={"GET"}
     */
    public function GethistoricalRisk(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $historicalrisk = $entityManager->getRepository(HistoricalRisk::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($historicalrisk, 'json', ["attributes" => ['id' ,  'Criticite' , 'Decision' , 'StateRisk' ,
            'Commentaires' ,  'Processlie'  , 'Strategique' ,'Date' , 'NumeroAction'=> ['id' , 'Origine']]]);
        return new JsonResponse($response);
    }



    /**
     * @Route("/GetNbreRiskState", name="GetNbreRiskState")
     * methods={"GET"}
     */
    public function GetNbreRiskState(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $nbState = $entityManager->getRepository(Risk::class)->getNbreStateRisk();


        return new JsonResponse($nbState);
    }


    /**
     * @Route("/GetcategoryriskNumber", name="GetcategoryriskNumber")
     * methods={"GET"}
     */
    public function GetcategoryriskNumber(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $nbcategory = $entityManager->getRepository(Risk::class)->getNbreCategoryRisk();


        return new JsonResponse($nbcategory);
    }

}
