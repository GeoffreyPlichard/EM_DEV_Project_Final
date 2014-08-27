<?php

namespace Mobility\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
# Import des modules
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Configuration;

# On importe la classe Request pour afficher un formulaire
use Symfony\Component\HttpFoundation\Request as Request;

# Pour afficher un formulaire, importer les types
use Mobility\PublicBundle\Entity\EcoActors;
use Mobility\PublicBundle\Form\EcoActorsType;
use Mobility\PublicBundle\Entity\Comments;
use Mobility\PublicBundle\Form\CommentsType;

use Doctrine\Common\Util\Debug as Debug;


class FrontPagesController extends Controller
{

	/**
	* @Route(name="public.frontpages.index")
	* @Template("PublicBundle:FrontPages:index.html.twig")
	*/

    public function indexAction()
    {
        $doctrine = $this->getDoctrine();
    	$entity = $doctrine
    		->getRepository('Mobility\PublicBundle\Entity\EcoActors')
    		->find(1);

        # echo '<pre>'; Debug::dump($entities); echo '</pre>'; exit();

        return array(
        	'entity' => $entity
        );
    }


	/**
	* @Route("/actualites", name="public.frontpages.actualites")
	* @Template("PublicBundle:FrontPages:actualites.html.twig")
	*/

    public function actualitesAction()
    {
        $doctrine = $this->getDoctrine();
    	$entity = $doctrine
    		->getRepository('Mobility\AccessBundle\Entity\News')
    		->findAll();

        # echo '<pre>'; Debug::dump($entities); echo '</pre>'; exit();

        return array(
        	'entity' => $entity
        );
    }


    /**
	* @Route("/projet", name="public.frontpages.projet")
	* @Template("PublicBundle:FrontPages:projet.html.twig")
	*/	

	public function projetAction()
	{
		return array();
	}


	/**
	* @Route("/experiences", name="public.frontpages.experiences")
	* @Template("PublicBundle:FrontPages:experiences.html.twig")
	*/

	public function experiencesAction()
	{
		$doctrine = $this->getDoctrine();
    	$entity = $doctrine
    		->getRepository('Mobility\PublicBundle\Entity\EcoActors')
    		->findAll();

        # echo '<pre>'; Debug::dump($entities); echo '</pre>'; exit();

        return array(
        	'entity' => $entity
        );
	}


	/**
	* @Route("/experience/{id}", name="public.frontpages.experience")
	* @Template("PublicBundle:FrontPages:experience.html.twig")
	*/

	public function experienceAction($id, Request $request)
	{
		$doctrine = $this->getDoctrine();
    	$entity = $doctrine
    		->getRepository('Mobility\PublicBundle\Entity\EcoActors')
    		->find($id);

    	$commentShow = $doctrine
    		->getRepository('Mobility\PublicBundle\Entity\Comments')
    		->findBy(array(
    			'ecoactor' => $id
    		));


    	$comment = new Comments();

		$form = $this->createForm(new CommentsType, $comment);
		$form->handleRequest($request);

        # echo '<pre>'; Debug::dump($entities); echo '</pre>'; exit();

        if ($form->isValid())
        {
            $data = $form->getData();
            $doctrine = $this->getDoctrine();
			$em = $doctrine->getManager();

			$em->persist($data);
			$em->persist($comment->setStatus("publish"));
			$em->persist($comment->setSpam("no spam"));
			$em->persist($comment->setEcoactor($entity));
            $em->flush();

            # getFlashBab() stocke un message en session une seule fois : une fois affiché il est détruit
            $request->getSession()->getFlashBag()->set('notice', 'Merci pour votre commentaire. Il sera affiché une fois validé.');

            # Créé une URL
            $url = $this->generateUrl('public.frontpages.experience', array('id'=> $id));
            # On fait la redirection
            return $this->redirect($url);

           
        }

        return array(
        	'entity' => $entity,
        	'form' => $form->createView(),
        	'comments' => $commentShow
        );
	}	


	/**
	* @Route("/participe", name="public.frontpages.participe")
	* @Template("PublicBundle:FrontPages:participe.html.twig")
	*/

	public function participeAction(Request $request)
	{

		$type = new EcoActorsType();
		$form = $this->createForm($type);
		$form->handleRequest($request);

		if ($form->isValid())
        {
            $data = $form->getData();
            $doctrine = $this->getDoctrine();
			$em = $doctrine->getManager();

			# Récupération de l'utilisateur qui correspond à l'adresse email
			$email = $data->getUserActor();
			$email = $email->getEmail();
			$actor = $em
				->getRepository('Mobility\PublicBundle\Entity\UserActor')
				->findOneBy(array(
    				'email' => $email
    			));


			# Si il n y a pas d'utilisateur avec cette email, on l'ajoute, sinon on "set" l'entité avec
		    # l'utilisateur qui existe déjà.
			if ($actor == null)
		    {
		    	$data->getUseractor()->setGestotal($data->getGes()); # Remplissage du Gesttotal avec le ges de l'expérience
		        $em->persist($data);
            	$em->flush();
		    }
		    else
		    {
		    	$currentGes = $actor->getGesTotal();
		    	$experienceGes = $data->getGes();
		    	$newGes = $currentGes + $experienceGes;
		    	$actor->setGestotal($newGes); // Mise à jour du GES total
		    	$actor->setGame($data->getUseractor()->getGame()); // Mise à jour du boolean jeu
		    	$data->setUseractor($actor);
		        $em->persist($data);
            	$em->flush();
		    }
			
            # getFlashBab() stocke un message en session une seule fois : une fois affiché il est détruit
            $request->getSession()->getFlashBag()->set('notice', 'Votre parcours a bien été ajouté. Merci de votre participation !');

            # Créé une URL
            $url = $this->generateUrl('public.frontpages.participe');
            # On fait la redirection
            return $this->redirect($url);

           
        }

		return array(
			'form' => $form->createView()
		);
	}


	/**
	* @Route("/contact", name="public.frontpages.contact")
	* @Template("PublicBundle:FrontPages:contact.html.twig")
	*/

	public function contactAction()
	{
		return array();
	}


	/**
	* @Route("/legals", name="public.frontpages.legals")
	* @Template("PublicBundle:FrontPages:legals.html.twig")
	*/

	public function legalsAction()
	{
		return array();
	}
}
