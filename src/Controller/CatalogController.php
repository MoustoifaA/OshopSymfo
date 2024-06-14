<?php

namespace App\Controller;


use App\Entity\Type;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/catalog', name: 'app_catalog_')]
class CatalogController extends AbstractController
{

    #[Route('/type/{id}', methods:'GET', name: 'type', requirements:["id" => "\d+"])]
    public function type(Type $type): Response
    {
        $productList = $type->getProducts();

        return $this->render('catalog/type.html.twig', [
            'productList' => $productList,
            'type' => $type]);
    }

    #[Route('/category/{id}', name: 'categories', requirements: ['id' => '\d+'])]
    public function category(Category $category): Response
    {

        return $this->render('catalog/category.html.twig', [
            'products' => $category->getProducts(),
            'category' => $category

        ]);
    }
}
