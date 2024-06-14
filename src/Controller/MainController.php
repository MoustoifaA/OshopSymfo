<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', name: 'app_main_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(CategoryRepository $categoryRepository): Response
    {

        // creations d'un tableau associatif pour cle = homeOrder et valeur categorie
        $categories = $categoryRepository->getHomeOrder();
        $homeOrderList = [];
        foreach ($categories as $category) {
            $homeOrderList[$category->getHomeOrder()] = $category;
         }

        return $this->render('main/home.html.twig',
    [
        'categories' => $homeOrderList
    ]);
    }

}
