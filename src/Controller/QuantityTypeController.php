<?php


namespace App\Controller;

use App\Entity\QuantityType;
use App\Repository\QuantityTypeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuantityTypeController extends BaseController
{
    /** @var QuantityTypeRepository */
    private QuantityTypeRepository $quantityTypeRepository;

    /**
     * RecipeController constructor.
     * @param QuantityTypeRepository $quantityTypeRepository
     * @param SerializerInterface $serialize
     */
    public function __construct(QuantityTypeRepository $quantityTypeRepository, SerializerInterface $serialize)
    {
        parent::__construct($serialize);
        $this->quantityTypeRepository = $quantityTypeRepository;
    }

    /**
     * @Route("/quantity-types", name="app_get_all_quantity_types", methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $quantityTypes = $this->quantityTypeRepository->findAll();

        return $this->response($quantityTypes, QuantityType::GROUP_QUANTITY_TYPE);
    }

    /**
     * @Route("/quantity-types/{quantity_type_id}", name="app_get_one_quantity_type", requirements={"quantity_type_id": "\d+"}, methods={"GET"})
     * @ParamConverter("quantityType", options={"id" = "quantity_type_id"})
     * @param QuantityType $quantityType
     * @return JsonResponse
     */
    public function getOne(QuantityType $quantityType)
    {
        return $this->response($quantityType, QuantityType::GROUP_QUANTITY_TYPE);
    }

    /**
     * @Route("/quantity-types", name="app_post_quantity_types", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        /** @var QuantityType $quantityType */
        $quantityType = $this->handleRequest(QuantityType::class, QuantityType::GROUP_QUANTITY_TYPE, $request);
        try {
            return $this->response($this->quantityTypeRepository->create($quantityType), QuantityType::GROUP_QUANTITY_TYPE, Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $this->response(null, null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/quantity-types/{quantity_type_id}", name="app_patch_quantity_type", requirements={"quantity_type_id": "\d+"}, methods={"PATCH"})
     * @ParamConverter("quantityType", options={"id" = "quantity_type_id"})
     * @param QuantityType $quantityType
     * @param Request $request
     * @return JsonResponse
     */
    public function update(QuantityType $quantityType, Request $request)
    {
        try {
            $data = $this->decodeContent($request);
            $quantityType = $this->quantityTypeRepository->update($quantityType, $data['name']);
            return $this->response($quantityType,QuantityType::GROUP_QUANTITY_TYPE,  Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->response(null, null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/quantity-types/{quantity_type_id}", name="app_remove_quantity_type", requirements={"quantity_type_id": "\d+"}, methods={"DELETE"})
     * @ParamConverter("quantityType", options={"id" = "quantity_type_id"})
     * @param QuantityType $quantityType
     * @return JsonResponse
     */
    public function delete(QuantityType $quantityType)
    {
        try {
            return $this->response($this->quantityTypeRepository->remove($quantityType),QuantityType::GROUP_QUANTITY_TYPE, Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->response(null, null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}