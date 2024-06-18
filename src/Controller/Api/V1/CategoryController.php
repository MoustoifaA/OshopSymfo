<?php

namespace App\Controller\Api\V1;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/category', name: 'app_api_v1_category_')]
class CategoryController extends AbstractController
{
    #[Route('/', name: 'browse')]
    public function browse(CategoryRepository $categoryRepository): JsonResponse
    {
        return $this->json($categoryRepository->findAll(), 200, [], ['groups' => 'product_browse']);
    }



    #[Route('/{id}', name: 'products', methods: ["GET"], requirements: ["id" => "\d+"])]
    public function products(Category $category): JsonResponse
    {
        return $this->json($category->getProducts(), 200, [], ['groups' => 'product_browse']);
    }
}
