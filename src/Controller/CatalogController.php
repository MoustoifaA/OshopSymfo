<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Type;
use App\Entity\Category;
use App\Entity\Product;
use App\Service\Pagination;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

#[Route('/catalog', name: 'app_catalog_')]
class CatalogController extends AbstractController
{

    #[Route('/type/{id}', methods:'GET', name: 'type', requirements:["id" => "\d+"])]
    public function type(Type $type, Pagination $pagination, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $products = $pagination->paginateItem($page, $type->getProducts());

        return $this->render('catalog/base_productList.html.twig', [
            'products' => $products,
            'type' => $type,
            'count' => count($type->getProducts())
        ]);
    }

    #[Route('/category/{id}', name: 'categories', requirements: ['id' => '\d+'])]
    public function category(Category $category, Pagination $pagination, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $products = $pagination->paginateItem($page, $category->getProducts());

        return $this->render('catalog/base_productList.html.twig', [
            'products' => $products,
            'category' => $category,
            'count' => count($category->getProducts())

        ]);
    }

    #[Route('/brand/{id}', name: 'brand', requirements: ['id' => '\d+'])]
    public function brand(Brand $brand, Pagination $pagination, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $products = $pagination->paginateItem($page, $brand->getProducts());

        return $this->render('catalog/base_productList.html.twig', [
            'products' => $products,
            'brand' => $brand,
            'count' => count($brand->getProducts())

        ]);
    }


    #[Route('/product/{id}', name: 'product', requirements: ['id' => '\d+'])]
    public function product(Product $product): Response
    {

        return $this->render('catalog/product_details.html.twig', [
            'product' => $product,
        ]);
    }
}
