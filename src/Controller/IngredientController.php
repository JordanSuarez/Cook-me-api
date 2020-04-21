<?php


namespace App\Controller;


use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class IngredientController extends AbstractController
{
    /**
     * @Route("/ingredients", name="app_get_all_ingredients", methods={"GET"})
     * @param IngredientRepository $ingredientRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAllIngredients(IngredientRepository $ingredientRepository, SerializerInterface $serializer)
    {
        $ingredients = $ingredientRepository->findAll();
        return new JsonResponse(json_decode($serializer->serialize($ingredients, 'json', ['groups' => 'group_ingredient'])));
    }
}