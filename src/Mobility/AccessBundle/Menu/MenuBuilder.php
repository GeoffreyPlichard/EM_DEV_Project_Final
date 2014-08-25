<?php

  namespace Mobility\AccessBundle\Menu;

  use Knp\Menu\FactoryInterface;
  use Symfony\Component\HttpFoundation\Request;

  class MenuBuilder
  {
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createBreadcrumbMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        // cet item sera toujours affiché
        $menu->addChild('Admin', array('route' => 'access.default.index'));

        // crée le menu en fonction de la route
        switch($request->get('_route')){
            // ACTUALITES //
            case 'access.news.index':
                $menu
                    ->addChild('Actualités')
                    ->setCurrent(true)
                    // setCurrent est utilisé pour ajouter une classe css "current"
                ;
            break;
            case 'access.news.post':
                $menu->addChild('Actualités', array('route' => 'access.news.index'));
                $menu
                    ->addChild('Création')
                    ->setCurrent(true)
                    // setCurrent est utilisé pour ajouter une classe css "current"
                ;
            break;
            case 'access.news.update':
                $menu->addChild('Actualités', array('route' => 'access.news.index'));
                $menu
                    ->addChild('Modifier')
                    ->setCurrent(true)
                    // setCurrent est utilisé pour ajouter une classe css "current"
                ;
            break;
            // ACTUALITES //
            case 'access.comments.index':
                $menu
                    ->addChild('Commentaires')
                    ->setCurrent(true)
                    // setCurrent est utilisé pour ajouter une classe css "current"
                ;
            break;
            // EXPERIENCES //
            case 'access.experiences.index':
                $menu
                    ->addChild('Expériences')
                    ->setCurrent(true)
                    // setCurrent est utilisé pour ajouter une classe css "current"
                ;
            break;
            // case 'Acme_list_post':
            //     $menu
            //         ->addChild('label.list.post')
            //         ->setCurrent(true)
            //     ;
            // break;
            // case 'Acme_view_post':
            //     $menu->addChild('label.list.post', array(
            //         'route' => 'Acme_list_post'
            //     ));
                
            //     $menu
            //         ->addChild('label.view.post')
            //         ->setCurrent(true)
            //         ->setLabel($request->get('label'))
            //         // le paramètre "label" doit être passé dans votre controller
            //         // avec $request->attributes->set('label','Mon libellé');
            //     ;
            // break;
            // case 'Acme_add_comment_on_post':
            //     $menu->addChild('label.list.post', array(
            //         'route' => 'Acme_list_post'
            //     ));
                
            //     $menu
            //         ->addChild('label.view.post', array(
            //             'route' => 'Acme_view_post',
            //             'routeParameters' => array('slug' => $request->get('slug'))
            //             /* le paramètre "slug" est un paramètre de la route
            //                Acme_add_comment_on_post. Si votre route n'a pas de paramètre, vous
            //                devrez utiliser la méthode $request->attributes->set()
            //             */
            //         ))
            //         ->setLabel($request->get('label'))
            //     ;
            //     $menu
            //         ->addChild('label.add.comment')
            //         ->setCurrent(true)
            //     ;                    
            // break;            
        }

        return $menu;
    }
}