<?php


namespace App\Controller;


use App\Entity\RecipeType;
use App\Repository\RecipeTypeRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RecipeTypeController extends BaseController
{
    /** @var RecipeTypeRepository */
    private RecipeTypeRepository $recipeTypeRepository;

    /**
     * RecipeTypeController constructor.
     * @param RecipeTypeRepository $recipeTypeRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(RecipeTypeRepository $recipeTypeRepository, SerializerInterface $serializer)
    {
        parent::__construct($serializer);
        $this->recipeTypeRepository = $recipeTypeRepository;
    }

    /**
     * @Route("/recipe-types", name="app_get_all_recipe_types", methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $recipeTypes = $this->recipeTypeRepository->findAll();

        return $this->response($recipeTypes, RecipeType::GROUP_RECIPE_TYPE);
    }

    /**
     * @Route("/recipe-type", name="app_get_one_recipe_types", methods={"GET"})
     * @return JsonResponse
     */
    public function getOne()
    {
        $recipeType = $this->recipeTypeRepository->findOneBy(['name' => 'type name 0']);

        return $this->response($recipeType, RecipeType::GROUP_RECIPE_TYPE);
    }

    /**
     * @Route("/recipe-types", name="app_post_recipe_types", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request)
    {
        /** @var RecipeType $recipeType */
        $recipeType = $this->handleRequest(RecipeType::class, RecipeType::GROUP_RECIPE_TYPE, $request);

        return $this->response($this->recipeTypeRepository->create($recipeType),RecipeType::GROUP_RECIPE_TYPE);
    }
}