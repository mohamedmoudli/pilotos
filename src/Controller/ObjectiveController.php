<?php


namespace App\Controller;


use App\Entity\CategoryOpportunity;
use App\Entity\Stake;
use App\Entity\historicalObjective;
use App\Entity\HistoricalOpportunity;
use App\Entity\HistoricalRisk;
use App\Entity\Objective;
use App\Entity\Opportunity;
use App\Entity\IntersetedParty;
use App\Entity\ActionPlan;
use App\Entity\Process;
use App\Entity\Risk;
use App\Entity\StrategicOpportunity;
use App\Entity\StrategicRisk;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ObjectiveController extends AbstractController
{



    /**
     * @Route("/CreateObjective", name="CreateObjective")
     */
    public function createObjective(Request $request): Response
    {
        // success

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $objective = new Objective();

            $idEnjeu = $request->get('idStake');
            $idprocess = $request->get('idprocess');


            $res = intval($idEnjeu);

            $res1 = intval($idprocess);
            $objective->setDescription($request->request->get('Description'));
            $objective->setTime1($request->request->get('Time1'));
            $objective->setTime2($request->request->get('Time2'));
            $objective->setTime3($request->request->get('Time3'));
            $objective->setTime4($request->request->get('Time4'));
            $objective->setTime2020($request->request->get('Time2020'));
            $objective->setTime2021($request->request->get('Time2021'));
            $indicateur = $request->request->get('PredefinedIndicator');
            $objective->setPredefinedIndicator($indicateur);
            if($indicateur){
                $processus = new Process();
                $processus = $em->getRepository(Process::class)->findOneById($res1);
                $objective->setPerformanceIndicator($processus->getPerformanceIndicator());
            }else{
                $objective->setPerformanceIndicator($request->request->get('PerformanceIndicator'));
            }

            $objective->setObjectiveToWait($request->request->get('ObjectiveToWait'));
            $objective->setInitialState($request->request->get('InitialState'));
            $objective->setCurrentState($request->request->get('CurrentState'));
            $objective->setCurrentStateIndiactor($request->request->get('CurrentStateIndiactor'));
            $objective->setComment($request->request->get('Comment'));

            $stake = $em->getRepository(Stake::class)->findOneById($res);


            $objective->setStake($stake);
            $processRisque = $em->getRepository(Process::class)->findOneById($res1);
            $objective->setProcessLie($processRisque);

            $em->persist($objective);

            $em->flush();
            return new JsonResponse('success');
        }

        return new JsonResponse('error1');
    }



    /**
     * @Route("/saveAvencementObjective", name="saveAvencementObjective")
     * methods={"GET"}
     */
    public function saveAvencementObjective(Request $request )
    {

        $entityManager = $this->getDoctrine()->getManager();

        $pipertinantes = $entityManager->getRepository(Objective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($pipertinantes, 'json', ["attributes" => ['id' ,  'NumAction'=> ['id' , 'Origine']]]);

        if(count($response)){
            /** @var IntersetedParty $pipertinante */
            foreach ($response as  $pipertinante ){;
                $pipertinanteObj = $this->getDoctrine()->getRepository(Objective::class)->find($pipertinante['id']);

                $numActions = $pipertinanteObj->getNumAction();
                $objective = new Objective();
                $somme =0;
                $count =0;
                foreach ($numActions as  $numAction ){
                    $count =$count + 1;
                    $somme = $somme + $numAction->getAdvancement();

                }

                if($count){
                    $pipertinanteObj->setAdvancement($somme/$count);
                }


                $entityManager->persist($pipertinanteObj);
                $entityManager->flush();
            }
        }
//        $res = json_encode($partieinteresse);

        return new JsonResponse('sucess');
    }




    /**
     * @Route("/savehistoricalObjective", name="savehistoricalObjective")
     * methods={"GET"}
     */
    public function savehistoriqueObjective(Request $request )
    {

        $entityManager = $this->getDoctrine()->getManager();

        $pipertinantes = $entityManager->getRepository(Objective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($pipertinantes, 'json', ["attributes" => ['id' ,'Description' ,'Time1' , 'Time2' ,'Time3' , 'Time4' , 'Time2020' ,'Time2021' ,
            'ProcessLie' , 'PredefinedIndicator' , 'PerformanceIndicator' , 'ObjectiveToWait', 'InitialState' , 'CurrentStateIndiactor' ,
            'Advancement', 'Commentaire' , 'CurrentState' , 'planDeActions'=> ['id' , 'Origine']]]);

        if(count($response)){
            /** @var IntersetedParty $pipertinante */
            foreach ($response as  $pipertinante ){
                $historique = new historicalObjective();
                $pipertinanteObj = $this->getDoctrine()->getRepository(Objective::class)->find($pipertinante['id']);
                $enjeu = new Stake();
                $enjeu = $pipertinanteObj->getStake();
                $processlie = new Process();
                $processlie = $pipertinanteObj->getProcessLie();
                $numActions = new ActionPlan();
                $numActions = $pipertinanteObj->getNumAction();
                foreach ($numActions as  $numAction ){
                    $historique->addNumAction($numAction);
                }

                $historique->setDescription($pipertinanteObj->getDescription());
                $historique->setTime1($pipertinanteObj->getTime1());
                $historique->setTime2($pipertinanteObj->getTime2());
                $historique->setTime3($pipertinanteObj->getTime3());
                $historique->setTime4($pipertinanteObj->getTime4());
                $historique->setTime2020($pipertinanteObj->getTime2020());
                $historique->setTime2021($pipertinanteObj->getTime2021());
                $historique->setPredefinedIndicator($pipertinanteObj->getPredefinedIndicator());
                $historique->setPerformanceIndicator($pipertinanteObj->getPerformanceIndicator());
                $historique->setObjectiveToWait($pipertinanteObj->getObjectiveToWait());
                $historique->setInitialState($pipertinanteObj->getInitialState());
                $historique->setCurrentStateIndicator($pipertinanteObj->getCurrentStateIndiactor());
                $historique->setAdvancement($pipertinanteObj->getAdvancement());
                $historique->setCurrentState($pipertinanteObj->getCurrentState());
                $historique->setComment($pipertinanteObj->getComment());




                $historique->setStake($enjeu->getDescription());
                $historique->setProcesslie($processlie->getProcess());

                $historique->setDate(new \DateTime());
                $entityManager->persist($historique);
                $entityManager->flush();
            }
        }
//        $res = json_encode($partieinteresse);

        return new JsonResponse('sucess');
    }


    /**
     * @Route("/GetObjectiveByAction", name="GetObjectiveByAction")
     * methods={"GET"}
     */



    public function GetObjectiveByAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(Objective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriesrisque, 'json', ["attributes" => ['id' ,  'Description' , 'Stake' , 'Time1' , 'Time2' , 'Time3' , 'Time4' ,
            'Time2020' , 'Time2021' , 'ProcessLie' , 'PredefinedIndicator' , 'PerformanceIndicator' , 'ObjectiveToWait' ,
            'InitialState' ,  'NumAction'=> ['id' , 'Origine'] , 'CurrentStateIndicator'  , 'Advancement' , 'CurrentState' ,
            'Comment']]);
        return new JsonResponse($response);
    }


    /**
     * @Route("/GethistoricalObjective", name="GethistoricalObjective")
     * methods={"GET"}
     */
    public function GethistoriqueObjective(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $historiqueOpportunite = $entityManager->getRepository(historicalObjective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($historiqueOpportunite, 'json', ["attributes" => ['id' ,   'Description' , 'Stake' , 'Time1' , 'Time2' , 'Time3' , 'Time4' ,
            'Time2020' , 'Time2021' , 'ProcessLie' , 'PredefinedIndicator' , 'PerformanceIndicator' , 'ObjectiveToWait' ,
            'InitialState' ,  'NumAction'=> ['id' , 'Origin'] , 'CurrentStateIndicator' , 'Advancement' , 'CurrentState' , 'Comment' , 'Date'
            ]]);
        return new JsonResponse($response);
    }


}