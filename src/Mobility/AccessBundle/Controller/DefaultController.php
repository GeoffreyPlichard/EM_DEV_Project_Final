<?php

namespace Mobility\AccessBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Configuration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


use Doctrine\Common\Util\Debug as Debug;

/**
 * @Route("/admin")
 */

class DefaultController extends Controller
{
    /**
     * @Route("/", name="access.default.index")
     * @Security("is_granted('ROLE_ADMIN')")
     * @Template("AccessBundle:Default:index.html.twig")
     */
    public function indexAction()
    {

    	// Récupérer le nombre de news
    	$rc = $this->getDoctrine()->getRepository('AccessBundle:News');
    	$news_total = $rc->createQueryBuilder('nb_news')
    			->select('COUNT(nb_news)')
				->getQuery()
				->getSingleScalarResult();

		// Récupérer le nombre de commentaires
    	$rc = $this->getDoctrine()->getRepository('PublicBundle:Comments');
    	$com_total = $rc->createQueryBuilder('nb_coms')
    			->select('COUNT(nb_coms)')
				->getQuery()
				->getSingleScalarResult();

		// Récupérer le nombre d' expériences
    	$rc = $this->getDoctrine()->getRepository('PublicBundle:EcoActors');
    	$eco_total = $rc->createQueryBuilder('nb_ecos')
    			->select('COUNT(nb_ecos)')
				->getQuery()
				->getSingleScalarResult();


        return array(
        	'news_total' => $news_total,
        	'com_total' => $com_total,
        	'eco_total' => $eco_total
        );
    }

}
