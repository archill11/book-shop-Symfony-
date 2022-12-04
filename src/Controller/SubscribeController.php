<?php

namespace App\Controller;

use App\Attribute\RequestBody;
use App\Model\SubscriberRequest;
use App\Service\SubscriberService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use App\Model\ErrorResponse;
use Symfony\Component\HttpFoundation\Request;

class SubscribeController extends AbstractController {
  public function __construct(private SubscriberService $subscriberService) {}

  /**
   * @OA\Response(
   *     response=200,
   *     description="Subscribe email to newsletter mailing list"
   * )
   * @OA\Response(
   *     response="400",
   *     description="Validation failed",
   *     @Model(type=ErrorResponse::class)
   * )
   * @OA\RequestBody(@Model(type=SubscriberRequest::class))
   */
  #[Route(path: '/api/v1/subscribe', methods: ['POST'])]
  public function subscribe(Request $request) {

    $post_data = json_decode($request->getContent(), true);
    $dateEmail = $post_data['email'];
    $dateAgreed = $post_data['agreed'];
    $SubscriberDto = new SubscriberRequest( $dateEmail, $dateAgreed );
    $this->subscriberService->subscribe($SubscriberDto);

    return $this->json("sucess");
  }
}
