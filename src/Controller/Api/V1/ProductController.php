<?php

namespace App\Controller\Api\V1;

use DateTimeImmutable;
use App\Entity\Product;
use App\Form\ProductType;
use PhpParser\Node\Expr\Print_;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/v1/product', name: 'app_api_v1_product_')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'browse')]
    public function browse(ProductRepository $productRepository): JsonResponse
    {
        return $this->json($productRepository->findAll(), 200, [], ['groups' => 'product_browse']);
    }

    #[Route('/{id}', name: 'read', methods: ["GET"], requirements: ["id" => "\d+"])]
    public function read(ProductRepository $productRepository,int $id): JsonResponse
    {
        if (is_null($productRepository->find($id)))
        {
            $info = [
                'message' => 'Product not found',
                'success' => false,
            ];
            return $this->json($info, Response::HTTP_NOT_FOUND);
        }
        return $this->json($productRepository->find($id), 200, [], ['groups' => 'product_browse']);
    }
    
    #[Route('/{id}/edit', name: 'edit', methods: ['PATCH', 'PUT'], requirements: ["id" => "\d+"])]
    public function edit(
        int $id, 
        EntityManagerInterface $em, 
        ProductRepository $productRepository, 
        Request $request, 
        SerializerInterface $serializer,
        ValidatorInterface $validator
        
        ): Response
    {
        //Recuperation du produit a editer
        $product = $productRepository->find($id);


        //verification si le produit est pas null
        if (is_null($product))
        {
            $info = [
                'message' => 'Product not found',
                'success' => false,
            ];
            return $this->json($info, Response::HTTP_NOT_FOUND);
        }

        // on récupère le json brut de la requete
        $json = $request->getContent();


        $serializer->deserialize($json, Product::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $product]);

        $errors = $validator->validate($product);
        // si des erreurs ont été détectées
        if (count($errors) > 0)
        {
            // on les renvoit au client
            $info = [
                'success' => false,
                'error_message' => 'Validation error',
                'error_code' => 'product_validation_error',
                'errors' => $errors
            ];
            return $this->json($info, Response::HTTP_BAD_REQUEST);
        }


        //envoie des datas
         $em->flush();

        
        return $this->json($product, Response::HTTP_OK, [], ["groups" => "product_browse"]);
                
    }


    #[Route('/', name: 'add', methods: "POST")]
    public function add(EntityManagerInterface $em, Request $request, ValidatorInterface $validator): Response
    {
        // 1. récupérer les données
        // https://symfony.com/doc/current/components/http_foundation.html#accessing-request-data
        $data = $request->getPayload();
        $name = $data->get('name');

        // 2. valider les données
        // pour valider les données avec le validator, 
        // on créer une entité 
        $product = new Product();

        // et le validator vérifiera les contraintes définies dessus
        $errors = $validator->validate($product);
        // si des erreurs ont été détectées
        if (count($errors) > 0)
        {
            // on les renvoit au client
            $info = [
                'success' => false,
                'error_message' => 'Erreur de validation',
                'error_code' => 'prod$product_validation_error',
                'errors' => $errors
            ];
            return $this->json($info, Response::HTTP_BAD_REQUEST);
        }

        // ici on est sur que les données sont valides

        // 3. faire le traitement des données
        // ici insérer le prod$product en BDD
        $em->persist($product);
        $em->flush();

        // 4. renvoyer une réponse en JSON

        return $this->json($product, Response::HTTP_CREATED, [], ["groups" => "product_browse"]);
    }



}
