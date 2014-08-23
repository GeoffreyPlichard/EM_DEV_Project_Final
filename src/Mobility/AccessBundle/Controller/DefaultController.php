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
        return array();
    }

}
