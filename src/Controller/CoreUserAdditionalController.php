<?php

namespace App\Controller;

use App\Constant\Constants;
use AppBundle\Entity\CoreAdminAdditional;
use AppBundle\Entity\CoreAgency;
use AppBundle\Entity\CoreRole;
use AppBundle\Entity\CoreRoleTransactionAccess;
use App\Entity\User;
use AppBundle\Entity\CoreUserAdditional;
use AppBundle\Entity\CoreUserRole;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoreUserAdditionalController extends AbstractController
{

    /**
     * @Route(
     *     name="api_core_user_create",
     *     path="/api/core-user-additionals/create",
     *     methods={"POST"},
     *     defaults={
     *          "_api_resource_class"=CoreUserAdditional::class,
     *          "_api_collection_name"="api_core_user_create"
     *      }
     *  )
     */
    public function createAction(Request $request)
    {
        return $this->get('app.coreUserAdditional.service')->persist($request, 'create');
    }

    /**
     * @Route(
     *     name="api_core_user_edit",
     *     path="/api/core-user-additionals/{id}/edit",
     *     methods={"PUT"},
     *     defaults={
     *          "_api_resource_class"=CoreUserAdditional::class,
     *          "_api_item_name"="api_core_user_edit"
     *      }
     *  )
     */
    public function editAction(Request $request, User $user)
    {
        return $this->get('app.coreUserAdditional.service')->persist($request, 'edit', $user);
    }

    /**
     * @Route("/api/core-user-additionals/check-unique-by-email/{email}",
     *     name="core_user_additional_check_unique_email",
     *     requirements={
     *          "email"=".+"
     *      }
     * )
     * @Method({"GET"})
     */
    public function checkUniqueEmailAction($email)
    {
        $em = $this->getDoctrine()->getManager();
        $coreUser = $em->getRepository(User::class)->findOneBy(array(
            'email' => $email
        ));

        return new JsonResponse(array(
            'isUnique' => is_null($coreUser)
        ));
    }

    /**
     * @Route(
     *     name="core_user_additional_waiting_for_validation",
     *     path="/api/core-user-additionals/waiting-for-validation",
     *     methods={"GET","POST"},
     *     defaults={"_api_resource_class"=CoreUserAdditional::class, "_api_collection_operation_name"="core_user_additional_waiting_for_validation"}
     * )
     */
    public function getUsersWaitingForValidationAction(Request $request)
    {
        return $this->container->get('app.coreUserAdditional.service')
            ->getUserAdditionalsForPagination(Constants::STATUS_WAITING_FOR_VALIDATION, $request);
    }

    /**
     * @Route("/api/core-user-additionals/change-status-in-organization/{id}/status/{status}", name="change_status_user_in_organization")
     * @Method({"POST"})
     */
    public function changeUserStatusInOrganizationAction(Request $request, User $user, $status)
    {
        $em = $this->getDoctrine()->getManager();

        if ($status === 'true') {
            //validate
            $user->setStatus(Constants::STATUS_VALID);
            $user->setEnabled(true);
            $content = json_decode($request->getContent());

            $defaultAgency = $em->getRepository(CoreAgency::class)->findOneBy(array(
                'isDefault' => true,

            ));
            $user->addCoreAgency($defaultAgency);

            foreach ($content->coreRoles as $role) {
                $coreRole = $em->getRepository(CoreRole::class)->find($role);
                $coreUserRole = new CoreUserRole();
                $coreUserRole->setCoreRole($coreRole);
                $coreUserRole->setCoreOrganizationTypeId($request->get('selectedOrganizationType'));
                $coreUserRole->setCoreOrganizationId($request->get('selectedOrganization'));
                $coreUserRole->setCoreUser($user);
                $user->addCoreUserRole($coreUserRole);
            }

            // token to validate account
            $tokenGenerator = $this->container->get('fos_user.util.token_generator');
            $token = $tokenGenerator->generateToken();
            $user->setConfirmationToken($token);

            // sending email after changing status to validated
            $this->container->get('app.send_email')->send('be806',
                $user->getLocale(), [$user->getEmail()], null, null, [],
                ['email' => $user->getEmail(), 'organization' => $user->getCoreOrganizations()->first()->getCompanyName()]);

            $em->persist($user);
            $em->flush();

            return new Response('', 201);
        } else {
            // refuse
            $user->setStatus(Constants::STATUS_REFUSED);
            $user->setEnabled(false);
            $em->persist($user);
            $em->flush();

            // sending email after changing status to refused
            $this->container->get('app.send_email')->send('38ef6', $user->getLocale(), [$user->getEmail()]);
            return new Response('', 201);
        }
    }

    /**
     * @Route(
     *     name="core_user_additional_get_item",
     *     path="/api/core-user-additionals/{id}/get-item",
     *     )
     * @Method({"GET"})
     */
    public function getItemAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        return new JsonResponse($em->getRepository(User::class)->getItem($id));
    }


}