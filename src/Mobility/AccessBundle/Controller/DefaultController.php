<?php

namespace Mobility\AccessBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Configuration;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

# Dès qu'on veut afficher un formulaire, on importe la classe Request
use Symfony\Component\HttpFoundation\Request as Request;

use Mobility\AccessBundle\Form\UserType;
use Mobility\AccessBundle\Entity\User;

use Doctrine\Common\Util\Debug as Debug;

/**
 * @Route("/admin")
 */

class DefaultController extends Controller
{
    /**
     * @Route("/", name="access.default.index")
     * @Template("AccessBundle:Default:index.html.twig")
     */
    public function indexAction()
    {
        return array();
    }
}
