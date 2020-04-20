<?php


namespace App\Controller;


use App\Entity\CategorieOpportunite;
use App\Entity\CategorieRisque;
use App\Entity\Opportunite;
use App\Entity\Processus;
use App\Entity\Risque;
use App\Entity\StrategiqueOpportunite;
use App\Entity\StrategiqueRisque;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            if($poids < 4 ){
                $opportunite->setDecision('opportunité negligable a ignorer');
            }
            if( 4 <= $poids ){
                if( 9 > $poids){
                    $opportunite->setDecision('opportunité moderéé a reflechir');
                }
            }
            if($poids > 9 ){
                $opportunite->setDecision('opportunité interssésante a saisir');
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
            $strategiquerisque = $em->getRepository(StrategiqueOpportunite::class)->findOneById($res);
            dump($strategiquerisque);

            $opportunite->setStategique($strategiquerisque);
            $processRisque = $em->getRepository(Processus::class)->findOneById($res1);
            $opportunite->setProcessLie($processRisque);
            $CategorieRisque = $em->getRepository(CategorieOpportunite::class)->findOneById($res2);
            $opportunite->setCategorieOpportunite($CategorieRisque);
            $opportunite->setEtatOpportunite($request->request->get('EtatRisque'));
            $opportunite->setCommentaire($request->request->get('Commentaire'));


            $em->persist($opportunite);

            $em->flush();
            return new JsonResponse('success');
        }

        return new JsonResponse('error1');
    }


}