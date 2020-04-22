<?php


namespace App\Controller;


use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class IngredientController extends BaseController
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

    /**
     * @Route("/ingredients", name="app_post_ingredient", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param IngredientRepository $ingredientRepository
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request, SerializerInterface $serializer, IngredientRepository $ingredientRepository)
    {
        $content = $request->getContent();
        /** @var Ingredient $ingredient */
        $ingredient = $serializer->deserialize($content, Ingredient::Class, 'json', ['groups' => 'group_ingredient']);
        $ingredientRepository->create($ingredient);
        return new JsonResponse(json_decode($serializer->serialize($ingredient, 'json', ['groups' => 'group_ingredient'])));
    }
}