<?php

namespace Mobility\AccessBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Configuration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

// On importe la classe Request pour afficher un formulaire
use Symfony\Component\HttpFoundation\Request as Request;

// Pour afficher un formulaire, importer les types
use Mobility\AccessBundle\Entity\User;
use Mobility\AccessBundle\Form\UserType;
use Mobility\AccessBundle\Entity\News;
use Mobility\AccessBundle\Form\NewsType;


use Doctrine\Common\Util\Debug as Debug;

/**
 * @Route("/admin")
 */

class ActualiteController extends Controller
{
    /**
     * @Route("/actualites", name="access.news.index")
     * @Template("AccessBundle:News:index.html.twig")
     */
    public function indexAction()
    {
        $doctrine = $this->getDoctrine();
    	$entity = $doctrine
    		->getRepository('Mobility\AccessBundle\Entity\News')
    		->findAll();

        // echo '<pre>'; Debug::dump($entities); echo '</pre>'; exit();

        return array(
        	'entity' => $entity
        );
    }

    /**
     * @Route("/actualites/creation", name="access.post.index")
     * @Template("AccessBundle:News:post.html.twig")
     */

    public function postAction(Request $request){
    	
    	$news = new News();
		$form = $this->createForm(new NewsType, $news);
		$form->handleRequest($request);


		# Récupération du nom de l'utilisateur en session
		$username = $this->getUser()->getUsername();
		$doctrine = $this->getDoctrine();
		# Cherche l'User dont le nom est = à celui de l'utilisateur en session
    	$entity = $doctrine
    		->getRepository('Mobility\AccessBundle\Entity\User')
    		->findOneBy(array(
    			'username' => $username
    		));


		if ($form->isValid())
        {
            $data = $form->getData();
            $doctrine = $this->getDoctrine();
			$em = $doctrine->getManager();
			$em->persist($data);
			$em->persist($news->setUser($entity));
            $em->flush();

            # getFlashBab() stocke un message en session une seule fois : une fois affiché il est détruit
            $request->getSession()->getFlashBag()->set('notice', 'Votre actualité a bien été ajoutée.');

            # Créé une URL
            $url = $this->generateUrl('access.news.index');
            # On fait la redirection
            return $this->redirect($url);

           
        }

		return array(
			'form' => $form->createView()
		);

    }

}
