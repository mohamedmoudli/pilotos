<?php


namespace App\Controller;


use App\Entity\CategorieOpportunite;
use App\Entity\Enjeu;
use App\Entity\HistoriqueObjective;
use App\Entity\HistoriqueOpportunite;
use App\Entity\HistoriqueRisque;
use App\Entity\Objective;
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

            $idEnjeu = $request->get('idEnjeu');
            $idprocess = $request->get('idprocess');


            $res = intval($idEnjeu);

            $res1 = intval($idprocess);
            $objective->setDescription($request->request->get('Description'));
            $objective->setTemps1($request->request->get('Temps1'));
            $objective->setTemps2($request->request->get('Temps2'));
            $objective->setTemps3($request->request->get('Temps3'));
            $objective->setTemps4($request->request->get('Temps4'));
            $objective->setTemps2020($request->request->get('Temps2020'));
            $objective->setTemps2021($request->request->get('Temps2021'));
            $indicateur = $request->request->get('IndicateurPredefini');
            $objective->setIndicateurPredefini($indicateur);
            if($indicateur){
                $processus = new Processus();
                $processus = $em->getRepository(Processus::class)->findOneById($res1);
                $objective->setIndicateurPerformance($processus->getIndicateurPerformance());
            }else{
                $objective->setIndicateurPerformance($request->request->get('IndicateurPerformance'));
            }

            $objective->setObjectiveAAtendre($request->request->get('ObjectiveAAtendre'));
            $objective->setEtatInitial($request->request->get('EtatInitial'));
            $objective->setEtatActuel($request->request->get('EtatActuel'));
            $objective->setEtatActuelIndiacteur($request->request->get('EtatActuelIndiacteur'));
            $objective->setCommentaire($request->request->get('Commentaire'));

            $enjeu = $em->getRepository(Enjeu::class)->findOneById($res);


            $objective->setEnjeu($enjeu);
            $processRisque = $em->getRepository(Processus::class)->findOneById($res1);
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
    public function savehistoriqueRisque(Request $request )
    {

        $entityManager = $this->getDoctrine()->getManager();

        $pipertinantes = $entityManager->getRepository(Objective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($pipertinantes, 'json', ["attributes" => ['id' ,  'NumAction'=> ['id' , 'Origine']]]);

        if(count($response)){
            /** @var Partieinteresse $pipertinante */
            foreach ($response as  $pipertinante ){;
                $pipertinanteObj = $this->getDoctrine()->getRepository(Objective::class)->find($pipertinante['id']);

                $numActions = $pipertinanteObj->getNumAction();
                $objective = new Objective();
                $somme =0;
                $count =0;
                foreach ($numActions as  $numAction ){
                    $count =$count + 1;
                    $somme = $somme + $numAction->getAction();

                }
                dump($somme);
                dump($count);
                if($count){
                    $pipertinanteObj->setAvencement($somme/$count);
                }


                $entityManager->persist($pipertinanteObj);
                $entityManager->flush();
            }
        }
//        $res = json_encode($partieinteresse);

        return new JsonResponse('sucess');
    }




    /**
     * @Route("/savehistoriqueObjective", name="savehistoriqueObjective")
     * methods={"GET"}
     */
    public function savehistoriqueObjective(Request $request )
    {

        $entityManager = $this->getDoctrine()->getManager();

        $pipertinantes = $entityManager->getRepository(Objective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($pipertinantes, 'json', ["attributes" => ['id' ,'Description' ,'CourtTerm' , 'MoyenTerm' ,'LongTerm' , 'Causes' , 'Censequence' ,'Gravite' , 'Probabilite' , 'detectabilite' , 'Criticite' , 'Decision' , 'EtatRisque' , 'Commentaire' , 'Processus'  , 'StrategiqueRisque' , 'planDeActions'=> ['id' , 'Origine']]]);

        if(count($response)){
            /** @var Partieinteresse $pipertinante */
            foreach ($response as  $pipertinante ){
                $historique = new HistoriqueObjective();
                $pipertinanteObj = $this->getDoctrine()->getRepository(Objective::class)->find($pipertinante['id']);
                $enjeu = new Enjeu();
                $enjeu = $pipertinanteObj->getEnjeu();
                $processlie = new Processus();
                $processlie = $pipertinanteObj->getProcessLie();
                $numActions = new PlanDeAction();
                $numActions = $pipertinanteObj->getNumAction();
                foreach ($numActions as  $numAction ){
                    $historique->addNumAction($numAction);
                }

                $historique->setDescription($pipertinanteObj->getDescription());
                $historique->setTemps1($pipertinanteObj->getTemps1());
                $historique->setTemps2($pipertinanteObj->getTemps2());
                $historique->setTemps3($pipertinanteObj->getTemps3());
                $historique->setTemps4($pipertinanteObj->getTemps4());
                $historique->setTemps2020($pipertinanteObj->getTemps2020());
                $historique->setTemps2021($pipertinanteObj->getTemps2021());
                $historique->setIndicateurPredefini($pipertinanteObj->getIndicateurPredefini());
                $historique->setIndicateurPerformance($pipertinanteObj->getIndicateurPerformance());
                $historique->setObjectiveAttendre($pipertinanteObj->getObjectiveAAtendre());
                $historique->setEtatInitial($pipertinanteObj->getEtatInitial());
                $historique->setEtatActuelIndicateur($pipertinanteObj->getEtatActuelIndiacteur());
                $historique->setAvencement($pipertinanteObj->getAvencement());
                $historique->setEtatActuel($pipertinanteObj->getEtatActuel());
                $historique->setCommentaire($pipertinanteObj->getCommentaire());




                $historique->setEnjeux($enjeu->getDescription());
                $historique->setProcesslie($processlie->getProcessus());

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



    public function GetOpportuniteByAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(Objective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriesrisque, 'json', ["attributes" => ['id' ,  'Description' , 'Enjeu' , 'Temps1' , 'Temps2' , 'Temps3' , 'Temps4' ,
            'Temps2020' , 'Temps2021' , 'ProcessLie' , 'IndicateurPredefini' , 'IndicateurPerformance' , 'ObjectiveAAtendre' ,
            'EtatInitial' ,  'NumAction'=> ['id' , 'Origine'] , 'EtatActuelIndiacteur' , 'Avencement' , 'EtatActuel' ,
            'Commentaire']]);
        return new JsonResponse($response);
    }


    /**
     * @Route("/GethistoriqueObjective", name="GethistoriqueObjective")
     * methods={"GET"}
     */
    public function GethistoriqueObjective(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $historiqueOpportunite = $entityManager->getRepository(HistoriqueObjective::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($historiqueOpportunite, 'json', ["attributes" => ['id' ,  'Description' , 'Date' ,
            'Temps1'  ,'Temps2' ,'Temps3' , 'Temps4' , 'Temps2020' , 'Temps2021' , 'IndicateurPredefini','IndicateurPerformance',
            'ObjectiveAttendre','EtatInitial','EtatActuelIndicateur','Avencement','EtatActuel','Commentaire','Enjeux' ,'Processlie',
            'NumAction'=> ['id' , 'Origine']]]);
        return new JsonResponse($response);
    }


}