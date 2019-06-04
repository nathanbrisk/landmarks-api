<?php

namespace App\Http\Controllers;

use App\Interactors\GetCanadianProvincesUseCase;
use App\Interactors\GetCanadianProvinceUseCase;
use App\Repositories\CachingMysqlCanadianProvincesRepository;
use App\Http\GetCanadianProvinceRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Exceptions\NoCanadianProvincesException;
use App\Exceptions\InvalidSlugException;
use App\Exceptions\UnrecognizedSlugException;

class CanadianProvincesController extends Controller
{
    protected $canadianProvincesRepository;

    public function __construct()
    {
        $this->canadianProvincesRepository = new CachingMysqlCanadianProvincesRepository();
    }

    /**
     * @OA\Get(
     *     path="/landmarks-api/canadian-provinces",
     *     description="Return all Canadian provinces",
     *     @OA\Response(
     *         response="200",
     *         @OA\MediaType(mediaType="application/json"),
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         @OA\MediaType(mediaType="application/json"),
     *         description="server error"
     *     )
     * )
     */

    public function showAll()
    {
        $useCase = new GetCanadianProvincesUseCase($this->canadianProvincesRepository);
        $all = $useCase->all();

        try {
            if (! $all) {
                throw new NoCanadianProvincesException('No active Canadian provinces found');
            } else {
                return response()->json($all);
            }
        } catch (NoCanadianProvincesException $e) {
            $e->report($e->getMessage());
            return $e->render();
        }
    }

    /**
     * @OA\Get(
     *     path="/landmarks-api/canadian-provinces/{slug}",
     *     description="Return a single Canadian province by slug",
     *     @OA\Parameter(
     *         description="Slug of Canadian province to return",
     *         in="path",
     *         name="slug",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         @OA\MediaType(mediaType="application/json"),
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid slug supplied"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Canadian province not found"
     *     ),
     * )
     */

    public function showOne($slug = null)
    {
        $request = ['slug'=>$slug];
        $validator = Validator::make($request, [
            'slug' => 'required|alpha_dash'
        ]);

        try {
            if ($validator->fails()) {
                // $validator->errors()
                throw new InvalidSlugException('Invalid Canadian province slug supplied: '.$slug);
            }

            $useCase = new GetCanadianProvinceUseCase($this->canadianProvincesRepository);
            $request = new GetCanadianProvinceRequest($slug);
            $one = $useCase->show($request);

            if (! $one) {
                throw new UnrecognizedSlugException('Canadian province not found: '.$slug);
            } else {
                return response()->json($one);
            }
        } catch (InvalidSlugException $e) {
            $e->report($e->getMessage());
            return $e->render();
        } catch (UnrecognizedSlugException $e) {
            $e->report($e->getMessage());
            return $e->render();
        }
    }
}
