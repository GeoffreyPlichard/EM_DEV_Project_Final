<?php

namespace Mobility\AccessBundle\Controller;

# Importation des classes

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Configuration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request as Request;

use Mobility\AccessBundle\Form\UserType;
use Mobility\AccessBundle\Entity\User;

use Symfony\Component\Security\Core\SecurityContext;

use Doctrine\Common\Util\Debug as Debug;


class UserController extends Controller
{
    /**
     * @Route("/compte/creation", name="access.user.creation")
     * @Template("AccessBundle:User:creation.html.twig")
     */
    public function creationAction(Request $request)
    {
        $type = new UserType();
        $form = $this->createForm($type);
        $form->handleRequest($request);

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
         # Récupération de l'entité rôle
        $role = $doctrine->getRepository('AccessBundle:Role');

        if ($form->isValid())
        {
            $data = $form->getData();

            # Cryptage du mot de passe
            $service = $this->get('security.encoder_factory');
            $password = $data->getPassword();
            $passwordEncoded = password_hash($password, PASSWORD_BCRYPT);
            $data->setPassword($passwordEncoded);
            // echo '<pre>'; Debug::dump($data); echo '</pre>'; exit();

            # Attribution du rôle user par défaut
            $roleUser = $role->findOneBy(
                array(
                    'name' => 'user'
                )
            );

            $data->addRole($roleUser);

            # Stockage de l'entité en mémoire
            $em->persist($data);
            # Insertion dans la base de données
            $em->flush();

            $request->getSession()->getFlashBag()->set('notice', 'Votre compte a été créé !');

            # Redirection
            $url = $this->generateUrl('access.user.creation');
            return $this->redirect($url);
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/login", name="access.user.login")
     * @Template("AccessBundle:User:login.html.twig")
     */
    public function loginAction(Request $request)
    {
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );
    }

    /**
     * @Route("/login_check", name="access.user.security_check")
     */
    public function securityCheckAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/logout", name="access.user.logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request
    }

    /**
     * @Route("/deconnexion", name="access.user.landing")
     * @Template("AccessBundle:User:landing.html.twig")
     */
    public function landingAction()
    {
        return array();
    }
}
