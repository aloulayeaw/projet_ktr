<?php

namespace App\Controller;

use App\Form\EntrepreneurType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EntrepreneurRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class KtrController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/sec/new" , name="new")
     */
    public function add(EntityManagerInterface $manager, Request $request)
    {   
        $form = $this->createForm(EntrepreneurType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            
            $user= $this->getUser();
            $entrepreneur = $form->getData();            
            $manager->persist($entrepreneur);
            $manager->flush();

            $this->addFlash(
                'notice',
                'Informations ajoutées'
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('new.html.twig', [
            'form' => $form->createView(),
        ]);
        
    }
}
