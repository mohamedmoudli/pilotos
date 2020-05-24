<?php


namespace App\Controller;


use App\Entity\CategoryOpportunity;
use App\Entity\CategoryRisk;
use App\Entity\StateOpportunity;
use App\Entity\HistoricalOpportunity;
use App\Entity\HistoricalRisk;
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

class OpportunityController extends AbstractController
{
    /**
     * @Route("/CreateOppOrtunite", name="CreateOppOrtunite")
     */
    public function createOpportunity(Request $request): Response
    {
        // success

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $opportunity = new Opportunity();

            $opportunity->setDescription($request->request->get('Description'));
            $opportunity->setShortTerm($request->request->get('ShortTerm'));
            $opportunity->setMediumTerm($request->request->get('MediumTerm'));
            $opportunity->setLongTerm($request->request->get('LongTerm'));
            $opportunity->setDateIdentification($request->request->get('DateIdentification'));
            $opportunity->setConsistency($request->request->get('Consistency'));
            $opportunity->setAlignment($request->request->get('Alignment'));
            $opportunity->setPresence($request->request->get('Presence'));
            $opportunity->setSkills($request->request->get('Skills'));
            $opportunity->setContinuity($request->request->get('Continuity'));
            $opportunity->setGain($request->request->get('Gain'));
            $opportunity->setEfforts($request->request->get('Efforts'));
            $opportunity->setAdvantage($request->request->get('Advantage'));
            $load = $request->request->get('Efforts') * $request->request->get('Advantage');
            $opportunity->setWeight($load);
            if($load < 4 ){
                $opportunity->setDecision('opportunité negligable a ignorer');
            }
            if( 4 <= $load ){
                if( 9 > $load){
                    $opportunity->setDecision('opportunité moderéé a reflechir');
                }
            }
            if($load >= 9 ){
                $opportunity->setDecision('opportunité interssésante a saisir');
            }
            $idStrategic = $request->get('idstrategic');
            $idprocess = $request->get('idprocess');
            $idcategory = $request->get('idcategory');
            $idEtatOpportunite = $request->get('idStateOpportunity');


            $strategiquerisque = $em->getRepository(StrategicOpportunity::class)->findOneById($idStrategic);


            $opportunity->setStrategicOpportunity($strategiquerisque);
            $processRisk = $em->getRepository(Process::class)->findOneById($idprocess);
            $opportunity->setProcessLie($processRisk);
            $CategoryRisk = $em->getRepository(CategoryOpportunity::class)->findOneById($idcategory);
            $opportunity->setCategoryOpportunity($CategoryRisk);
            $StateOpportunity = $em->getRepository(StateOpportunity::class)->findOneById($idEtatOpportunite);
            dump($strategiquerisque);
            $opportunity->setStateOpportunity($StateOpportunity);
            $opportunity->setComment($request->request->get('Comment'));


            $em->persist($opportunity);

            $em->flush();
            return new JsonResponse('success');
        }

        return new JsonResponse('error1');
    }





    /**
     * @Route("/UpdateOpportunity/{id}", name="UpdateOpportunity")
     */
    public function ReevaluateOpportunity(Request $request , $id): Response
    {
        // success

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $opportunity = new Opportunity();

            $opportunity = $em->getRepository(Opportunity::class)->findOneById($id);
            $opportunity->setEffortReevaluation($request->request->get('EffortReevaluation'));
            $opportunity->setAdvantageReevaluation($request->request->get('AventageReevaluation'));
            $load = $request->request->get('EffortReevaluation') * $request->request->get('AventageReevaluation');
            $opportunity->setloadReevaluation($load);
            dump($load);
            if($load < 4 ){
                $opportunity->setDecisionReevaluation('opportunité negligable a ignorer');
            }
            if( 4 <= $load ){
                if( 9 > $load){
                    $opportunity->setDecisionReevaluation('opportunité moderéé a reflechir');
                }
            }
            if($load >= 9 ){
                $opportunity->setDecisionReevaluation('opportunité interssésante a saisir');
            }
            $idStrategic = $request->get('idstrategicReevaluation');
            $idprocess = $request->get('idprocessReevaluation');
            $idcategory = $request->get('idcategoryReevaluation');
            $idStateOpportunity = $request->get('idStateOpportunityReevaluation');

            $strategiqueOpportunite = $em->getRepository(StrategicOpportunity::class)->findOneById($idStrategic);


            $opportunity->setStrategicReevaluation($strategiqueOpportunite);

            $processOpportunite = $em->getRepository(Process::class)->findOneById($idprocess);

            $opportunity->setProcessLieReevaluation($processOpportunite );
            $processOpportunity = $em->getRepository(StateOpportunity::class)->findOneById($idStateOpportunity);

            $opportunity->setStateOpportunityReevaluation($processOpportunity);



            $em->persist($opportunity);

            $em->flush();
            return new JsonResponse('success');
        }

        return new JsonResponse('error1');
    }




    /**
     * @Route("/savehistoricalOpportunity", name="savehistoricalOpportunity")
     * methods={"GET"}
     */
    public function savehistoricalOpportunity(Request $request )
    {

        $entityManager = $this->getDoctrine()->getManager();

        $opportunitys = $entityManager->getRepository(Opportunity::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($opportunitys, 'json', ["attributes" => ['id' , 'StateOpportunity' , 'Comment' ,  'NumAction'=> ['id' ]]]);
        if(count($response)){
            /** @var IntersetedParty $pipertinante */
            foreach ($response as  $historicalopportunity ){
                $historicalOpportunity = new HistoricalOpportunity();
                $opportunity = $this->getDoctrine()->getRepository(Opportunity::class)->find($historicalopportunity['id']);

                $numActions = new ActionPlan();
                $numActions = $opportunity->getNumAction();
                $numActionsreevaluation = new ActionPlan();
                $numActionsreevaluation  = $opportunity->getNumActionReevaluation();
                $stateOpportunity = new StateOpportunity();
                $stateOpportunity = $opportunity->getStateOpportunity();
                foreach ($numActions as  $numAction ){
                    $historicalOpportunity->addNumeroAction($numAction);
                }
                foreach ($numActionsreevaluation as  $numActionreevaluation ){
                    $historicalOpportunity->addNumeroAction($numActionreevaluation);
                }


                $historicalOpportunity->setEtat($stateOpportunity->getNameStateOpportunity());


                $historicalOpportunity->setCommentaire($opportunity->getComment());
                $historicalOpportunity->setDate(new \DateTime());

                $entityManager->persist($historicalOpportunity);
                $entityManager->flush();
            }
        }
//        $res = json_encode($partieinteresse);

        return new JsonResponse('sucess');
    }

    /**
     * @Route("/GetOpportunity", name="GetOpportunity")
     * methods={"GET"}
     */
    public function GetOpportunity(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $opportunity = $entityManager->getRepository(Opportunity::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($opportunity , 'json', ["attributes" => ['id' ,'Description' ,'ShortTerm' , 'MediumTerm' ,'LongTerm' ,
            'DateIdentification' ,  'Consistency' , 'Alignment' ,'Presence' , 'Skills' , 'Continuity' , 'Gain' , 'Efforts' ,
             'Advantage' , 'Weight' , 'Decision' ,'StrategicOpportunity'  , 'ProcessLie' , 'CategoryOpportunity' , 'StateOpportunity' ,
            'EffortReevaluation' , 'AdvantageReevaluation' , 'LoadReevaluation' ,'DecisionReevaluation' , 'StrategicReevaluation' ,
            'ProcessLieReevaluation' , 'StateOpportunityReevaluation' , 'Comment' , 'NumAction'=> ['id' , 'Origin'] ,
            'NumActionReevaluation'=> ['id' , 'Origin'] ]]);
        return new JsonResponse($response);
    }


    /**
     * @Route("/GethistoricalOpportunity", name="GethistoricalOpportunity")
     * methods={"GET"}
     */
    public function GethistoricalOpportunity(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $historicalOpportunity = $entityManager->getRepository(HistoricalOpportunity::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($historicalOpportunity, 'json', ["attributes" => ['id' ,  'Etat' , 'Commentaire'  ,'Date' ,
             'NumeroAction'=> ['id' , 'Origin']]]);
        return new JsonResponse($response);
    }




    /**
     * @Route("/GetOpportunityNumberState", name="GetOpportunityNumberState")
     * methods={"GET"}
     */
    public function GetOpportunityNumberState(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoryrisk = $entityManager->getRepository(Opportunity::class)->getNbreEtatOpportunite();


        return new JsonResponse($categoryrisk);
    }


    /**
     * @Route("/GetOpportunityCategoryNumber", name="GetOpportunityCategoryNumber")
     * methods={"GET"}
     */
    public function GetOpportunityCategoryNumber(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoryrisk = $entityManager->getRepository(Opportunity::class)->getNbreCategorieOpportunite();


        return new JsonResponse($categoryrisk);
    }

}