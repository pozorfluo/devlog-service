<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\RouterInterface;

class DevController extends AbstractController
{
    /**
     * not accessible as a route.
     */
    public function dumpRoutes(RouterInterface $router)
    {
        
        $routes = $router->getRouteCollection()->all();
        // dump($routes);

        $parameterLessRoutes = [];
        foreach ($routes as $name => $route) {
            // dump($route->__serialize()['compiled']->getPathVariables());
            // $compiledRoute = $route->__serialize()['compiled'];
            // if(isset($compiledRoute) && empty($compiledRoute->getPathVariables()))

            if (!strpos($route->getPath(), '{')) {
                $parameterLessRoutes[] = $name;
            }
        }

        return $this->render('dev/_routes.html.twig', [
            'routes' => $parameterLessRoutes,
        ]);
    }
}
