<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BranchController extends AbstractController
{
    /**
     * I want patch this part of the commit indeed
     * @Route("/branch", name="branch", methods={"GET","HEAD"})
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller, I want to split this into the two commits.',
            'path' => 'src/Controller/BranchController.php',
            'year' => date('d-m-Y'),
            'git' => 'actions',
        ]);
    }
}
