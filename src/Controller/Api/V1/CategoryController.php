<?php

namespace App\Controller\Api\V1;

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
}
