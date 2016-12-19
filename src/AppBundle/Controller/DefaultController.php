<?php

namespace AppBundle\Controller;

use BasicFlowBundle\Controller\StepInterface;
use BasicFlowBundle\Retainer\RetainerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller implements StepInterface
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/step1", name="step1")
     */
    public function step1Action(Request $request)
    {
        /** @var RetainerInterface $retainer */
        $retainer = $this->get('basic_flow.retainer.session');
        $retainer->clearPaging();
        $retainer->setData('step1', []);
        $retainer->removeData('step2');
        $retainer->removeData('step3');
        return $this->render('default/step1.html.twig', [
        ]);
    }

    /**
     * @Route("/step2", name="step2")
     */
    public function step2Action(Request $request)
    {
        /** @var RetainerInterface $retainer */
        $retainer = $this->get('basic_flow.retainer.session');
        $retainer->clearPaging();
        $retainer->setData('step2', []);
        $retainer->removeData('step3');
        return $this->render('default/step2.html.twig', [
        ]);
    }

    /**
     * @Route("/step3", name="step3")
     */
    public function step3Action(Request $request)
    {
        /** @var RetainerInterface $retainer */
        $retainer = $this->get('basic_flow.retainer.session');
        $retainer->clearPaging();
        $retainer->setData('step3', []);
        return $this->render('default/step3.html.twig', [
        ]);
    }
}
