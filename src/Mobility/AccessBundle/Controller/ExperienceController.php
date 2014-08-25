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
use Mobility\PublicBundle\Entity\EcoActors;
use Mobility\PublicBundle\Form\EcoActorsType;
// use Mobility\AccessBundle\Entity\News;
// use Mobility\AccessBundle\Form\NewsType;


use Doctrine\Common\Util\Debug as Debug;

/**
 * @Route("/admin")
 */

class ExperienceController extends Controller
{
    /**
     * @Route("/experiences", name="access.experiences.index")
     * @Template("AccessBundle:Experiences:index.html.twig")
     */
    public function indexAction()
    {
        $doctrine = $this->getDoctrine();
    	$entity = $doctrine
    		->getRepository('Mobility\PublicBundle\Entity\EcoActors')
    		->findAll();

        // echo '<pre>'; Debug::dump($entities); echo '</pre>'; exit();

        return array(
        	'entity' => $entity
        );
    }

}
