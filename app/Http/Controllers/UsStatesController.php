<?php

namespace App\Http\Controllers;

use App\Interactors\GetUsStatesUseCase;
use App\Interactors\GetUsStateUseCase;
use App\Repositories\CachingMysqlUsStatesRepository;
use App\Http\GetUsStateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Exceptions\NoUsStatesException;
use App\Exceptions\InvalidSlugException;
use App\Exceptions\UnrecognizedSlugException;

class UsStatesController extends Controller
{
    protected $usStatesRepository;

    public function __construct()
    {
        $this->usStatesRepository = new CachingMysqlUsStatesRepository();
    }

    /**
     * @OA\Get(
     *     path="/landmarks-api/us-states",
     *     description="Return all US states",
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
        $useCase = new GetUsStatesUseCase($this->usStatesRepository);
        $all = $useCase->all();

        try {
            if (! $all) {
                throw new NoUsStatesException('No active US states found');
            } else {
                return response()->json($all);
            }
        } catch (NoUsStatesException $e) {
            $e->report($e->getMessage());
            return $e->render();
        }
    }

    /**
     * @OA\Get(
     *     path="/landmarks-api/us-states/{slug}",
     *     description="Return a single US state by slug",
     *     @OA\Parameter(
     *         description="Slug of US state to return",
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
     *         description="US state not found"
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
                throw new InvalidSlugException('Invalid US state slug supplied: '.$slug);
            }

            $useCase = new GetUsStateUseCase($this->usStatesRepository);
            $request = new GetUsStateRequest($slug);
            $one = $useCase->show($request);

            if (! $one) {
                throw new UnrecognizedSlugException('US state not found: '.$slug);
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
