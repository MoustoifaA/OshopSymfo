<?php

namespace App\Controller;

use App\Entity\Brand;
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

        return $this->render('catalog/base_productList.html.twig', [
            'products' => $type->getProducts(),
            'type' => $type]);
    }

    #[Route('/category/{id}', name: 'categories', requirements: ['id' => '\d+'])]
    public function category(Category $category): Response
    {

        return $this->render('catalog/base_productList.html.twig', [
            'products' => $category->getProducts(),
            'category' => $category

        ]);
    }

    #[Route('/brand/{id}', name: 'brand', requirements: ['id' => '\d+'])]
    public function brand(Brand $brand): Response
    {

        return $this->render('catalog/base_productList.html.twig', [
            'products' => $brand->getProducts(),
            'brand' => $brand

        ]);
    }
}
