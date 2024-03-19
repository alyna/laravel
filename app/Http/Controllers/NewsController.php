<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsCollection;
use App\Models\NewsRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *      path="/api/news/{publishedDate}",
 *      description="Returns the news published in a specific date",
 *      tags={"News"},
 *      @OA\Parameter(
 *           name="publishedDate",
 *           description="Published date",
 *           required=true,
 *           in="path",
 *           @OA\Schema(
 *               type="string",
 *               format="datetime"
 *           )
 *       ),
 *       @OA\Response(
 *           response=200,
 *           description="Success"
 *       ),
 *       @OA\Response(
 *           response=401,
 *           description="Unauthenticated"
 *       ),
 *       @OA\Response(
 *           response=400,
 *           description="Bad Request"
 *       ),
 *       @OA\Response(
 *           response=404,
 *           description="not found"
 *       ),
 *       @OA\Response(
 *           response=403,
 *           description="Forbidden"
 *       )
 *  )
 */
class NewsController extends Controller
{
    /**
     * @param NewsRepositoryInterface $repository
     */
    public function __construct(private readonly NewsRepositoryInterface $repository)
    {
    }

    /**
     * Display a list of news filtered by a given published date
     *
     * @param Request $request
     * @param string $publishedDate
     * @return JsonResponse
     */
    public function index(Request $request, string $publishedDate): JsonResponse
    {
        // Get news based on the published date
        $newsCollection = new NewsCollection(
            $this->repository->getByPublishedDate($publishedDate)
        );

        // Return the news as JSON response
        return new JsonResponse([
            'total_results' => $newsCollection->count(),
            'news' => $newsCollection
        ]);
    }
}
