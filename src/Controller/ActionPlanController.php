<?php


namespace App\Controller;


use App\Entity\CategoryOpportunity;
use App\Entity\StateOpportunity;
use App\Entity\ExigencyInterestedParty;
use App\Entity\Objective;
use App\Entity\Opportunity;
use App\Entity\ActionPlan;
use App\Entity\Process;
use App\Entity\Risk;
use App\Entity\StrategicOpportunity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ActionPlanController extends AbstractController
{
    /**
     * @Route("/GetPlanActionByAction", name="GetPlanActionByAction")
     * methods={"GET"}
     */
    public function GetPlanActionByAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(ActionPlan::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriesrisque, 'json', ["attributes" => ['id' ,'Origin' , 'Description' , 'Action' , 'StartDatePanifies' ,'Delai' ,
            'Responsible' ,  'Director' , 'Consult' ,'Advancement' , 'Comment' , 'ClosingCriterion' , 'ProofOfClosure' , 'CriteriaEfficiency' ,
            'StateOfEfficacy' , 'CurrentState' , 'ExigencyInterestedParty'=>['id'] ,'Risk'=>['id']  , 'Opportunity'=>['id'] , 'OpportunityReevalution'=>['id'] , 'Objective'=>['id'] ]]);
        return new JsonResponse($response);
    }


    /**
     * @Route("/CreatePlandeAction", name="CreatePlandeAction")
     */
    public function createplandeAction(Request $request): Response
    {
        // success

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $planaction = new ActionPlan();


            $planaction->setOrigin($request->request->get('Origin'));
            $planaction->setAction($request->request->get('Action'));
            $planaction->setStartDatePanifies($request->request->get('StartDatePanifies'));
            $planaction->setDelai($request->request->get('Delai'));
            $planaction->setResponsible($request->request->get('Responsible'));
            $planaction->setDirector($request->request->get('Director'));
            $planaction->setConsult($request->request->get('Consult'));
            $planaction->setAdvancement($request->request->get('Advancement'));
            $planaction->setClosingCriterion($request->request->get('ClosingCriterion'));
            $planaction->setProofOfClosure($request->request->get('ProofOfClosure'));
            $planaction->setCriteriaEfficiency($request->request->get('CriteriaEfficiency'));
            $planaction->setStateOfEfficacy($request->request->get('StateOfEfficacy'));
            $planaction->setCurrentState($request->request->get('CurrentState'));
            $planaction->setComment($request->request->get('Comment'));

            $idExigency = $request->get('idExigency');
            $idrisk = $request->get('idrisk');
            $idobjective = $request->get('idObjective');
            $idOpportunity = $request->get('idOpportunity');
            $idOpportunityreevaluation = $request->get('idOpportunityreevaluation');

            $exigency = $em->getRepository(ExigencyInterestedParty::class)->findOneById($idExigency);
            if($exigency){
                $planaction->setExigencyInterestedParty($exigency);
            }

            $Risk = $em->getRepository(Risk::class)->findOneById($idrisk);
            if($Risk){
                $planaction->setRisk($Risk);
                $planaction->setDescription($Risk->getDescription());
            }

            $opportunity = $em->getRepository(Opportunity::class)->findOneById($idOpportunity);
            if($opportunity){
                $planaction->setOpportunity($opportunity);
                $planaction->setDescription($opportunity->getDescription());
            }
            $opportunityreevaluation = $em->getRepository(Opportunity::class)->findOneById($idOpportunityreevaluation);
            if($opportunityreevaluation){
                $planaction->setOpportunityReevalution($opportunityreevaluation);
                $planaction->setDescription($opportunityreevaluation->getDescription());
            }
            $objective = $em->getRepository(Objective::class)->findOneById($idobjective);
            if($objective){
                $planaction->setObjective($objective);
                $planaction->setDescription($objective->getDescription());
            }

            $em->persist($planaction);

            $em->flush();
            return new JsonResponse('success');
        }

        return new JsonResponse('error1');
    }

}