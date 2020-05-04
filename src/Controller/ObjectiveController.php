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

            $idStake = $request->get('idStake');
            $idprocess = $request->get('idprocess');


            $res = intval($idStake);

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
            $objective->setDescriptionStake($stake->getDescription());
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

        $objectives = $entityManager->getRepository(Objective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($objectives, 'json', ["attributes" => ['id' ,  'NumAction'=> ['id' , 'Origine']]]);

        if(count($response)){
            /** @var IntersetedParty $pipertinante */
            foreach ($response as  $pipertinante ){;
                $Objective = $this->getDoctrine()->getRepository(Objective::class)->find($pipertinante['id']);

                $numActions = $Objective->getNumAction();
                $objective = new Objective();
                $somme =0;
                $count =0;
                foreach ($numActions as  $numAction ){
                    $count =$count + 1;
                    $somme = $somme + $numAction->getAdvancement();

                }

                if($count){
                    $Objective->setAdvancement($somme/$count);
                }


                $entityManager->persist($Objective);
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
    public function savehistoricalObjective(Request $request )
    {

        $entityManager = $this->getDoctrine()->getManager();

        $objectives = $entityManager->getRepository(Objective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($objectives, 'json', ["attributes" => ['id' ,'Description' ,'Time1' , 'Time2' ,'Time3' , 'Time4' , 'Time2020' ,'Time2021' ,
            'ProcessLie' , 'PredefinedIndicator' , 'PerformanceIndicator' , 'ObjectiveToWait', 'InitialState' , 'CurrentStateIndiactor' ,
            'Advancement', 'Commentaire' , 'CurrentState' , 'planDeActions'=> ['id' , 'Origine']]]);

        if(count($response)){
            /** @var IntersetedParty $pipertinante */
            foreach ($response as  $pipertinante ){
                $historical = new historicalObjective();
                $objective = $this->getDoctrine()->getRepository(Objective::class)->find($pipertinante['id']);
                $stake = new Stake();
                $stake = $objective->getStake();
                $processlie = new Process();
                $processlie = $objective->getProcessLie();
                $numActions = new ActionPlan();
                $numActions = $objective->getNumAction();
                foreach ($numActions as  $numAction ){
                    $historical->addNumAction($numAction);
                }

                $historical->setDescription($objective->getDescription());
                $historical->setTime1($objective->getTime1());
                $historical->setTime2($objective->getTime2());
                $historical->setTime3($objective->getTime3());
                $historical->setTime4($objective->getTime4());
                $historical->setTime2020($objective->getTime2020());
                $historical->setTime2021($objective->getTime2021());
                $historical->setPredefinedIndicator($objective->getPredefinedIndicator());
                $historical->setPerformanceIndicator($objective->getPerformanceIndicator());
                $historical->setObjectiveToWait($objective->getObjectiveToWait());
                $historical->setInitialState($objective->getInitialState());
                $historical->setCurrentStateIndicator($objective->getCurrentStateIndiactor());
                $historical->setAdvancement($objective->getAdvancement());
                $historical->setCurrentState($objective->getCurrentState());
                $historical->setComment($objective->getComment());




                $historical->setStake($stake->getDescription());
                $historical->setProcesslie($processlie->getProcess());

                $historical->setDate(new \DateTime());
                $entityManager->persist($historical);
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
        $objectives = $entityManager->getRepository(Objective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($objectives, 'json', ["attributes" => ['id' ,  'Description' , 'DescriptionStake' , 'Time1' , 'Time2' , 'Time3' , 'Time4' ,
            'Time2020' , 'Time2021' , 'ProcessLie' , 'PredefinedIndicator' , 'PerformanceIndicator' , 'ObjectiveToWait' ,
            'InitialState' ,  'NumAction'=> ['id' , 'Origine'] , 'CurrentStateIndiactor'  , 'Advancement' , 'CurrentState' ,
            'Comment']]);
        return new JsonResponse($response);
    }


    /**
     * @Route("/GethistoricalObjective", name="GethistoricalObjective")
     * methods={"GET"}
     */
    public function GethistoricalObjective(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $historicalObjective = $entityManager->getRepository(historicalObjective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($historicalObjective, 'json', ["attributes" => ['id' ,   'Description' , 'Stake' , 'Time1' , 'Time2' , 'Time3' , 'Time4' ,
            'Time2020' , 'Time2021' , 'ProcessLie' , 'PredefinedIndicator' , 'PerformanceIndicator' , 'ObjectiveToWait' ,
            'InitialState' ,  'NumAction'=> ['id' , 'Origin'] , 'CurrentStateIndicator' , 'Advancement' , 'CurrentState' , 'Comment' , 'Date'
            ]]);
        return new JsonResponse($response);
    }


}