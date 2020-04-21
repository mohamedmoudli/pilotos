<?php


namespace App\Controller;


use App\Entity\CategorieOpportunite;
use App\Entity\CategorieRisque;
use App\Entity\HistoriqueOpportunite;
use App\Entity\HistoriqueRisque;
use App\Entity\Opportunite;
use App\Entity\Partieinteresse;
use App\Entity\PlanDeAction;
use App\Entity\Processus;
use App\Entity\Risque;
use App\Entity\StrategiqueOpportunite;
use App\Entity\StrategiqueRisque;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class OpportuniteController extends AbstractController
{
    /**
     * @Route("/CreateOppOrtunite", name="CreateOppOrtunite")
     */
    public function createOpportunite(Request $request): Response
    {
        // success

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $opportunite = new Opportunite();


            $opportunite->setDescription($request->request->get('Description'));
            $opportunite->setCourtTerm($request->request->get('CourtTerm'));
            $opportunite->setMoyenTerm($request->request->get('MoyenTerm'));
            $opportunite->setLongTerm($request->request->get('LongTerm'));
            $opportunite->setDateIdentification($request->request->get('DateIdentification'));
            $opportunite->setCoherence($request->request->get('Coherence'));
            $opportunite->setAllignement($request->request->get('Allignement'));
            $opportunite->setPresence($request->request->get('Presence'));
            $opportunite->setCompetences($request->request->get('Competences'));
            $opportunite->setContinute($request->request->get('Continute'));
            $opportunite->setGain($request->request->get('Gain'));
            $opportunite->setEfforts($request->request->get('Efforts'));
            $opportunite->setAventages($request->request->get('Aventages'));
            $poids = $request->request->get('Efforts') * $request->request->get('Aventages');
            $opportunite->setPoids($poids);
            dump($poids);
            if($poids < 4 ){
                $opportunite->setDecision('opportunité negligable a ignorer');
            }
            if( 4 <= $poids ){
                if( 9 > $poids){
                    $opportunite->setDecision('opportunité moderéé a reflechir');
                }
            }
            if($poids >= 9 ){
                $opportunite->setDecision('opportunité interssésante a saisir');
            }
            $idStrategique = $request->get('idstrategique');
            $idprocess = $request->get('idprocess');
            $idcategorie = $request->get('idcategorie');

            $res = intval($idStrategique);

            $res1 = intval($idprocess);

            $res2 = intval($idcategorie);
            $strategiquerisque = $em->getRepository(StrategiqueOpportunite::class)->findOneById($res);


            $opportunite->setStategique($strategiquerisque);
            $processRisque = $em->getRepository(Processus::class)->findOneById($res1);
            $opportunite->setProcessLie($processRisque);
            $CategorieRisque = $em->getRepository(CategorieOpportunite::class)->findOneById($res2);
            $opportunite->setCategorieOpportunite($CategorieRisque);
            $opportunite->setEtatOpportunite($request->request->get('EtatOpportunite'));
            $opportunite->setCommentaire($request->request->get('Commentaire'));


            $em->persist($opportunite);

            $em->flush();
            return new JsonResponse('success');
        }

        return new JsonResponse('error1');
    }





    /**
     * @Route("/UpdateOppOrtunite/{id}", name="UpdateOppOrtunite")
     */
    public function ReevaluationOpportunite(Request $request , $id): Response
    {
        // success

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $opportunite = new Opportunite();


            $opportunite = $em->getRepository(Opportunite::class)->findOneById($id);
            $opportunite->setEffortReevaluation($request->request->get('EffortReevaluation'));
            $opportunite->setAventageReevaluation($request->request->get('AventageReevaluation'));
            $poids = $request->request->get('EffortReevaluation') * $request->request->get('AventageReevaluation');
            $opportunite->setPoidsReevaluation($poids);
            dump($poids);
            if($poids < 4 ){
                $opportunite->setDecisionReevaluation('opportunité negligable a ignorer');
            }
            if( 4 <= $poids ){
                if( 9 > $poids){
                    $opportunite->setDecisionReevaluation('opportunité moderéé a reflechir');
                }
            }
            if($poids >= 9 ){
                $opportunite->setDecisionReevaluation('opportunité interssésante a saisir');
            }
            $idStrategique = $request->get('idstrategique');
            $idprocess = $request->get('idprocess');
            $idcategorie = $request->get('idcategorie');

            $res = intval($idStrategique);

            $res1 = intval($idprocess);

            $res2 = intval($idcategorie);
            $strategiqueOpportunite = $em->getRepository(StrategiqueOpportunite::class)->findOneById($res);
            $strategiqueOpportunite = new StrategiqueOpportunite();

            $opportunite->setStrategiqueEvaluation($strategiqueOpportunite);

            $processOpportunite = $em->getRepository(Processus::class)->findOneById($res1);
            $processOpportunite = new Processus();
            $opportunite->setProcessLieReevaluation($processOpportunite );

            $opportunite->setEtatOpportuniteReevaluation($request->request->get('EtatOpportuniteReevaluation'));



            $em->persist($opportunite);

            $em->flush();
            return new JsonResponse('success');
        }

        return new JsonResponse('error1');
    }




    /**
     * @Route("/savehistoriqueOpportunite", name="savehistoriqueOpportunite")
     * methods={"GET"}
     */
    public function savehistoriqueRisque(Request $request )
    {

        $entityManager = $this->getDoctrine()->getManager();

        $pipertinantes = $entityManager->getRepository(Opportunite::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($pipertinantes, 'json', ["attributes" => ['id' , 'EtatOpportunite' , 'Commentaire' ,  'NumAction'=> ['id' , 'Origine']]]);

        if(count($response)){
            /** @var Partieinteresse $pipertinante */
            foreach ($response as  $pipertinante ){
                $historique = new HistoriqueOpportunite();
                $pipertinanteObj = $this->getDoctrine()->getRepository(Opportunite::class)->find($pipertinante['id']);

                $numActions = new PlanDeAction();
                $numActions = $pipertinanteObj->getNumAction();
                foreach ($numActions as  $numAction ){
                    $historique->addNumeroAction($numAction);
                }


                $historique->setEtat($pipertinanteObj->getEtatOpportunite());


                $historique->setCommentaire($pipertinanteObj->getCommentaire());
                $historique->setDate(new \DateTime());
                dump($historique);
                $entityManager->persist($historique);
                $entityManager->flush();
            }
        }
//        $res = json_encode($partieinteresse);

        return new JsonResponse('sucess');
    }

    /**
     * @Route("/GetOpportuniteByAction", name="GetOpportuniteByAction")
     * methods={"GET"}
     */
    public function GetOpportuniteByAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(Opportunite::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriesrisque, 'json', ["attributes" => ['id' ,'Description' ,'CourtTerm' , 'MoyenTerm' ,'LongTerm' ,
            'DateIdentification' ,  'Coherence' , 'Allignement' ,'Presence' , 'Competences' , 'Continute' , 'Gain' , 'Efforts' ,
             'Aventages' , 'Poids' , 'Decision' ,'Stategique'  , 'ProcessLie' , 'CategorieOpportunite' , 'EtatOpportunite' ,
            'EffortReevaluation' , 'AventageReevaluation' , 'PoidsReevaluation' ,'DecisionReevaluation' , 'StrategiqueEvaluation' ,
            'ProcessLieReevaluation' , 'EtatOpportuniteReevaluation' , 'Commentaire' , 'NumAction'=> ['id' , 'Origine'] ,
            'NumActionReevaluation'=> ['id' , 'Origine'] ]]);
        return new JsonResponse($response);
    }


    /**
     * @Route("/GethistoriqueOpportunite", name="GethistoriqueOpportunite")
     * methods={"GET"}
     */
    public function GethistoriqueRisque(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $historiqueOpportunite = $entityManager->getRepository(HistoriqueOpportunite::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($historiqueOpportunite, 'json', ["attributes" => ['id' ,  'Etat' , 'Commentaire'  ,
             'NumeroAction'=> ['id' , 'Origine']]]);
        return new JsonResponse($response);
    }
}