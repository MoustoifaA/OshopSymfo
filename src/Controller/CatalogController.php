<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/catalog', name: 'app_catalog_')]
class CatalogController extends AbstractController
{
    #[Route('/category/{id}', name: 'categories', requirements: ['id' => '\d+'])]
    public function category(Category $category): Response
    {

        return $this->render('catalog/category.html.twig', [
            'products' => $category->getProducts(),
            'category' => $category
        ]);
    }
}
