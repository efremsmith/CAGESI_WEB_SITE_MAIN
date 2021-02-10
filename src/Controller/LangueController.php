<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LangueController extends AbstractController
{
    /**
     * @Route("/change_local/{locale}", name="change_local")
     */
    public function changeLocale($locale, Request $request )
    {
        //on stocks la langue demander dans la session
        $request->getSession()->set('_locale', $locale);
        
        //on revient sur la page precédente
        return $this->redirect($request->headers->get('referer'));
    }
}
