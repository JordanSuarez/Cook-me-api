<?php


namespace App\Controller;


use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class IngredientController extends BaseController
{
    /** @var IngredientRepository  */
    private IngredientRepository $ingredientRepository;

    /**
     * RecipeController constructor.
     * @param IngredientRepository $ingredientRepository
     * @param SerializerInterface $serialize
     */
    public function __construct(IngredientRepository $ingredientRepository, SerializerInterface $serialize)
    {
        parent::__construct($serialize);
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * @Route("/ingredients", name="app_get_all_ingredients", methods={"GET"})
     * @param IngredientRepository $ingredientRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAll(IngredientRepository $ingredientRepository, SerializerInterface $serializer)
    {
        $ingredients = $ingredientRepository->findAll();

        return $this->response($ingredients, Ingredient::GROUP_INGREDIENT);
    }

    /**
     * @Route("/ingredients/{ingredient_id}", name="app_get_one_ingredient", requirements={"ingredient_id": "\d+"} ,methods={"GET"})
     * @ParamConverter("ingredient", options={"id" = "ingredient_id"})
     * @param Ingredient $ingredient
     * @return JsonResponse
     */
    public function getOne(Ingredient $ingredient)
    {
        return $this->response($ingredient, Ingredient::GROUP_INGREDIENT);
    }

    /**
     * @Route("/ingredients", name="app_post_ingredient", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request)
    {
        /** @var Ingredient $ingredient */
        $ingredient = $this->handleRequest(Ingredient::class, Ingredient::GROUP_INGREDIENT, $request);

        return $this->response($this->ingredientRepository->create($ingredient), Ingredient::GROUP_INGREDIENT);
    }

    /**
     * @Route("/ingredients/{ingredient_id}", name="app_patch_ingredient", requirements={"ingredient_id": "\d+"} ,methods={"PATCH"})
     * @ParamConverter("ingredient", options={"id" = "ingredient_id"})
     * @param Ingredient $ingredient
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Ingredient $ingredient, Request $request)
    {
        $data = $this->decodeContent($request);
        try {
            $ingredient = $this->ingredientRepository->update($ingredient, $data['name'], $data['description'], $data['quantity']);
            return $this->response($ingredient,Ingredient::GROUP_INGREDIENT,  Response::HTTP_OK);
        } catch (ORMInvalidArgumentException $exception) {
            return $this->response(null, null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    /**
     * @Route("/ingredients/{ingredient_id}", name="app_remove_ingredient", requirements={"ingredient_id": "\d+"} ,methods={"DELETE"})
     * @ParamConverter("ingredient", options={"id" = "ingredient_id"})
     * @param Ingredient $ingredient
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Ingredient $ingredient)
    {
        return $this->response($this->ingredientRepository->remove($ingredient),Ingredient::GROUP_INGREDIENT);
    }
}