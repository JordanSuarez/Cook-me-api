<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends AbstractController
{
    const FORMAT = 'json';

    /** @var SerializerInterface  */
    protected SerializerInterface $serializer;

    /**
     * BaseController constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $object
     * @param $group
     * @return JsonResponse
     */
    protected function response($object, string $group)
    {
        return new JsonResponse(json_decode($this->serializer->serialize($object, self::FORMAT, ['groups' => $group])));
    }

    /**
     * @param $instanceType
     * @param string $group
     * @param Request $request
     * @return array|object
     */
    protected function handleRequest($instanceType, string $group, Request $request)
    {
        $content = $request->getContent();
        return $this->serializer->deserialize($content, $instanceType, self::FORMAT, ['groups' => $group]);
    }
}