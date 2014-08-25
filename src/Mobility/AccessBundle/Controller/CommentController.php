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
use Mobility\PublicBundle\Entity\Comments;
use Mobility\PublicBundle\Form\CommentsType;
// use Mobility\AccessBundle\Entity\News;
// use Mobility\AccessBundle\Form\NewsType;


use Doctrine\Common\Util\Debug as Debug;

/**
 * @Route("/admin")
 */

class CommentController extends Controller
{
    /**
     * @Route("/commentaires", name="access.comments.index")
     * @Template("AccessBundle:Comments:index.html.twig")
     */
    public function indexAction()
    {
        $doctrine = $this->getDoctrine();
    	$entity = $doctrine
    		->getRepository('Mobility\PublicBundle\Entity\Comments')
    		->findAll();

        // echo '<pre>'; Debug::dump($entities); echo '</pre>'; exit();

        return array(
        	'entity' => $entity
        );
    }

    /**
     * @Route("/commentaires/suppression/{id}", name="access.comments.delete")
     */

    public function deleteAction($id , Request $request){

        $doctrine = $this->getDoctrine();
        $news = $doctrine
            ->getRepository('Mobility\PublicBundle\Entity\Comments')
            ->find($id);

        $em = $doctrine->getManager();
        $em->remove($news);
        $em->flush();

        # getFlashBab() stocke un message en session une seule fois : une fois affiché il est détruit
        $request->getSession()->getFlashBag()->set('notice', 'Le commentaire a bien été supprimé.');

        # Créé une URL
        $url = $this->generateUrl('access.comments.index');
        # On fait la redirection
        return $this->redirect($url);

    }

}
