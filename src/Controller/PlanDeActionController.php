<?php


namespace App\Controller;


use App\Entity\CategorieOpportunite;
use App\Entity\EtatOpportunite;
use App\Entity\Exigencepi;
use App\Entity\Objective;
use App\Entity\Opportunite;
use App\Entity\PlanDeAction;
use App\Entity\Processus;
use App\Entity\Risque;
use App\Entity\StrategiqueOpportunite;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PlanDeActionController extends AbstractController
{
    /**
     * @Route("/GetPlanDeActionByAction", name="GetPlanDeActionByAction")
     * methods={"GET"}
     */
    public function GetOpportuniteByAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(PlanDeAction::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriesrisque, 'json', ["attributes" => ['id' ,'Origine' , 'Description' , 'Action' , 'DateDebutPanifie' ,'Delai' ,
            'Respensable' ,  'Realisateur' , 'Consulter' ,'Avencement' , 'Commentaire' , 'CritereDeCloture' , 'PreuveDeCloture' , 'CritaireEfficacite' ,
            'EtatDeEfficacite' , 'EtatActuel' , 'Exigencepi'=>['id'] ,'Risque'=>['id']  , 'opportunite'=>['id'] , 'opportuniteReevalution'=>['id'] , 'objective'=>['id'] ]]);
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
            $plandeaction = new PlanDeAction();


            $plandeaction->setOrigine($request->request->get('Origine'));
            $plandeaction->setAction($request->request->get('Action'));
            $plandeaction->setDateDebutPanifie($request->request->get('DateDebutPanifie'));
            $plandeaction->setDelai($request->request->get('Delai'));
            $plandeaction->setRespensable($request->request->get('Respensable'));
            $plandeaction->setRealisateur($request->request->get('Realisateur'));
            $plandeaction->setConsulter($request->request->get('Consulter'));
            $plandeaction->setAvencement($request->request->get('Avencement'));
            $plandeaction->setCritereDeCloture($request->request->get('CritereDeCloture'));
            $plandeaction->setPreuveDeCloture($request->request->get('PreuveDeCloture'));
            $plandeaction->setCritaireEfficacite($request->request->get('CritaireEfficacite'));
            $plandeaction->setEtatDeEfficacite($request->request->get('EtatDeEfficacite'));
            $plandeaction->setEtatActuel($request->request->get('EtatActuel'));
            $plandeaction->setCommentaire($request->request->get('Commentaire'));

            $idExigence = $request->get('idExigencepi');
            $idrisque = $request->get('idRisque');
            $idobjective = $request->get('idObjective');
            $idOpportunite = $request->get('idOpportunite');
            $idOpportunitereevaluation = $request->get('idOpportunitereevaluation');

            $exigence = $em->getRepository(Exigencepi::class)->findOneById($idExigence);
            if($exigence){
                $plandeaction->setExigencepi($exigence);
            }

            $Risque = $em->getRepository(Risque::class)->findOneById($idrisque);
            if($Risque){
                $plandeaction->setRisque($Risque);
                $plandeaction->setDescription($Risque->getDescription());
            }

            $opportunite = $em->getRepository(Risque::class)->findOneById($idOpportunite);
            if($opportunite){
                $plandeaction->setRisque($opportunite);
                $plandeaction->setDescription($opportunite->getDescription());
            }
            $opportunitereevaluation = $em->getRepository(Opportunite::class)->findOneById($idOpportunitereevaluation);
            if($opportunitereevaluation){
                $plandeaction->setOpportuniteReevalution($opportunitereevaluation);
                $plandeaction->setDescription($opportunitereevaluation->getDescription());
            }
            $objective = $em->getRepository(Objective::class)->findOneById($idobjective);
            if($objective){
                $plandeaction->setObjective($objective);
                $plandeaction->setDescription($objective->getDescription());
            }

            $em->persist($plandeaction);

            $em->flush();
            return new JsonResponse('success');
        }

        return new JsonResponse('error1');
    }

}