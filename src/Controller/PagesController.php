<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;




class PagesController extends AbstractController
{   

    /**
     * @Route("/", name="homepage")
     */
    
    public function index(): Response
    {

        $site_name = 'Roofus';
        $phone_name = 'iPhone X';

        return $this->render('pages/index.html.twig', [

            'site_name' => $site_name,
            'phone_name' => $phone_name,

        ]);
    }


    /**
     * @Route("/hello", name="hello")
     */
    
    public function hello(Request $request)
    {
        $name = $request->query->get ( 'name');
        if ($name != null) {
        $this->addFlash('info', 'Welcome back, '.$name.'. here\'some useful info');
        }

        return $this->render('pages/hello.html.twig', [
        'name' => $name,

        ]);
    }



}
