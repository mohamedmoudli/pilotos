<?php


namespace App\Controller;


use App\Entity\CategorieRisque;
use App\Entity\CategoriesEnjeuInterne;
use App\Entity\Exigencepi;
use App\Entity\HistoriquePI;
use App\Entity\HistoriqueRisque;
use App\Entity\Partieinteresse;
use App\Entity\PlanDeAction;
use App\Entity\Processus;
use App\Entity\Risque;
use App\Entity\StrategiqueRisque;
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

class RisqueControlleur extends AbstractController
{

    /**
     * @Route("/getRisque", name="getRisque")
     */
    public function createRisque(Request $request): Response
    {
        // success

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $risque = new Risque();


            $risque->setDescription($request->request->get('Description'));
            $risque->setCourtTerm($request->request->get('CourtTerm'));
            $risque->setMoyenTerm($request->request->get('MoyenTerm'));
            $risque->setLongTerm($request->request->get('LongTerm'));
            $risque->setDateIdentification($request->request->get('DateIdentification'));
            $risque->setCauses($request->request->get('Causes'));
            $risque->setCensequence($request->request->get('Censequence'));
            $risque->setGravite($request->request->get('Gravite'));
            $risque->setProbabilite($request->request->get('Probabilite'));
            $risque->setDetectabilite($request->request->get('Detectabilite'));
            $criticite = $request->request->get('Gravite') * $request->request->get('Probabilite') * $request->request->get('Detectabilite');
            $risque->setCriticite($criticite);
            if($criticite < 16 ){
                $risque->setDecision('Ok');
            }
            if( 16 <= $criticite ){
                if(32 > $criticite){
                    $risque->setDecision('Attention !!');
                }
            }
            if($criticite > 32 ){
                $risque->setDecision('stop');
            }
            $idStrategique = $request->get('idstrategique');
            $idprocess = $request->get('idprocess');
            $idcategorie = $request->get('idcategorie');
            dump($idStrategique);
            $res = intval($idStrategique);
            dump($res);
            $res1 = intval($idprocess);
            dump($res1);
            $res2 = intval($idcategorie);
            $strategiquerisque = $em->getRepository(StrategiqueRisque::class)->findOneById($res);
            dump($strategiquerisque);

            $risque->setStrategiqueRisque($strategiquerisque);
            $processRisque = $em->getRepository(Processus::class)->findOneById($res1);
            $risque->setProcessus($processRisque);
            $CategorieRisque = $em->getRepository(CategorieRisque::class)->findOneById($res2);
            $risque->setCategorieRisque($CategorieRisque);
            $risque->setEtatRisque($request->request->get('EtatRisque'));
            $risque->setCommentaire($request->request->get('Commentaire'));


            $em->persist($risque);

            $em->flush();
            return new JsonResponse('success');
        }

        return new JsonResponse('error1');
    }

    /**
     * @Route("/savehistoriqueRisque", name="savehistoriqueRisque")
     * methods={"GET"}
     */
    public function savehistoriqueRisque(Request $request )
    {

        $entityManager = $this->getDoctrine()->getManager();

        $pipertinantes = $entityManager->getRepository(Risque::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($pipertinantes, 'json', ["attributes" => ['id' ,'Description' ,'CourtTerm' , 'MoyenTerm' ,'LongTerm' , 'Causes' , 'Censequence' ,'Gravite' , 'Probabilite' , 'detectabilite' , 'Criticite' , 'Decision' , 'EtatRisque' , 'Commentaire' , 'Processus'  , 'StrategiqueRisque' , 'planDeActions'=> ['id' , 'Origine']]]);

        if(count($response)){
            /** @var Partieinteresse $pipertinante */
            foreach ($response as  $pipertinante ){
                $historique = new HistoriqueRisque();
                $pipertinanteObj = $this->getDoctrine()->getRepository(Risque::class)->find($pipertinante['id']);
                $strategique = new StrategiqueRisque();
                $strategique = $pipertinanteObj->getStrategiqueRisque();
                $processlie = new Processus();
                $processlie = $pipertinanteObj->getProcessus();
                $numActions = new PlanDeAction();
                $numActions = $pipertinanteObj->getPlanDeActions();
                foreach ($numActions as  $numAction ){
                    $historique->addNumeroAction($numAction);
                }






                $historique->setCriticite($pipertinanteObj->getCriticite());

                $historique->setDecision($pipertinanteObj->getDecision());



                $historique->setStrategique($strategique->getNomSrategique());
                $historique->setEtatRisque($pipertinanteObj->getEtatRisque());
                $historique->setProcesslie($processlie->getProcessus());

                $historique->setCommentaires($pipertinanteObj->getCommentaire());
                $historique->setDateENregistrement(new \DateTime());
                $entityManager->persist($historique);
                $entityManager->flush();
            }
        }
//        $res = json_encode($partieinteresse);

        return new JsonResponse('sucess');
    }




    /**
     * @Route("/GetRisqueByAction", name="GetRisqueByAction")
     * methods={"GET"}
     */
    public function GetRisqueByAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(Risque::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriesrisque, 'json', ["attributes" => ['id' ,'Description' ,'CourtTerm' , 'MoyenTerm' ,'LongTerm' , 'DateIdentification' ,  'Causes' , 'Censequence' ,'Gravite' , 'Probabilite' , 'detectabilite' , 'Criticite' , 'Decision' , 'EtatRisque' , 'Commentaire' , 'CategorieRisque' ,'Processus'  , 'StrategiqueRisque' , 'planDeActions'=> ['id' , 'Origine']]]);
        return new JsonResponse($response);
    }


    /**
     * @Route("/GetByAction", name="GetbyRisque")
     * methods={"GET"}
     */
    public function GetRisque(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(Risque::class)->findAll();
        dump($categoriesrisque);

        return new JsonResponse($categoriesrisque);
    }

    /**
     * @Route("/GethistoriqueRisque", name="GethistoriqueRisque")
     * methods={"GET"}
     */
    public function GethistoriqueRisque(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $categoriesrisque = $entityManager->getRepository(HistoriqueRisque::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $response = $serializer->normalize($categoriesrisque, 'json', ["attributes" => ['id' ,  'Criticite' , 'Decision' , 'EtatRisque' ,
            'Commentaires' ,  'Processlie'  , 'Strategique' ,'DateENregistrement' , 'NumeroAction'=> ['id' , 'Origine']]]);
        return new JsonResponse($response);
    }

}