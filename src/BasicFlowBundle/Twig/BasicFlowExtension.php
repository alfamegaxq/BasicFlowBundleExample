<?php

namespace BasicFlowBundle\Twig;

use BasicFlowBundle\Retainer\RetainerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;

class BasicFlowExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * @var RetainerInterface
     */
    private $retainer;

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
        if ($this->container->has('request_stack')) {
            $this->request = $this->container->get('request_stack');
        }
    }

    public function setRetainer(RetainerInterface $retainer)
    {
        $this->retainer = $retainer;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('next_flow_page', array($this, 'nextPage')),
            new \Twig_SimpleFunction('previous_flow_page', array($this, 'previousPage')),
        ];
    }

    /**
     * Returns url for next page
     *
     * @return bool|string
     */
    public function nextPage()
    {
        $step = $this->request->getCurrentRequest()->get('_route');

        /** @var Router $router */
        $router = $this->container->get('router');

        $stepConfig = $this->container->getParameter('basic_flow.params')['steps'];
        $currentActionId = array_search($step, $stepConfig);

        if ($currentActionId === false) {
            return $router->generate($stepConfig[0]);
        } else if (!isset($stepConfig[$currentActionId + 1])) {
            return false;
        }

        return $router->generate($stepConfig[$currentActionId + 1]);
    }

    /**
     * Returns url for previous page
     *
     * @return bool|string
     */
    public function previousPage()
    {
        $step = $this->request->getCurrentRequest()->get('_route');

        /** @var Router $router */
        $router = $this->container->get('router');

        $stepConfig = $this->container->getParameter('basic_flow.params')['steps'];
        $currentActionId = array_search($step, $stepConfig);

        if (!isset($stepConfig[$currentActionId - 1])) {
            return false;
        }

        return $router->generate($stepConfig[$currentActionId - 1]);
    }

    public function getName()
    {
        return 'basic_flow_extension';
    }
}