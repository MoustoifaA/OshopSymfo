<?php

namespace App\Controller\Api\V1;

use App\Entity\Brand;
use App\Repository\BrandRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/v1/brand', name: 'app_api_v1_brand_')]
class BrandController extends AbstractController
{
    #[Route('/', name: 'browse', methods: ["GET"])]
    public function browse(BrandRepository $brandRepository): JsonResponse
    {
        return $this->json($brandRepository->findAll(), 200, [], ['groups' => 'product_browse']);
    }


    #[Route('/{id}', name: 'products', methods: ["GET"], requirements: ["id" => "\d+"])]
    public function products(Brand $brand): JsonResponse
    {
        return $this->json($brand->getProducts(), 200, [], ['groups' => 'brand_products']);
    }
}
