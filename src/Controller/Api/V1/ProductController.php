<?php

namespace App\Controller\Api\V1;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/product', name: 'app_api_v1_product_')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'browse')]
    public function index(ProductRepository $productRepository): JsonResponse
    {
        return $this->json($productRepository->findAll(), 200, [], ['groups' => 'product_browse']);
    }
}
