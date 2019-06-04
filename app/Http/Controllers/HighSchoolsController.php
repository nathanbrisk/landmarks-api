<?php

namespace App\Http\Controllers;

use App\Interactors\GetHighSchoolsUseCase;
use App\Interactors\GetHighSchoolUseCase;
use App\Interactors\FindHighSchoolsUseCase;
use App\Repositories\CachingMysqlHighSchoolsRepository;
use App\Http\GetHighSchoolRequest;
use App\Http\FindHighSchoolsRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Exceptions\NoHighSchoolsException;
use App\Exceptions\InvalidTermException;
use App\Exceptions\InvalidSlugException;
use App\Exceptions\UnrecognizedSlugException;
use App\Exceptions\NoHighSchoolsFoundException;

class HighSchoolsController extends Controller
{
    protected $highSchoolsRepository;

    public function __construct()
    {
        $this->highSchoolsRepository = new CachingMysqlHighSchoolsRepository();
    }

    /**
     * @OA\Get(
     *     path="/landmarks-api/high-schools",
     *     description="Return all high schools or filter high schools by title",
     *     @OA\Parameter(
     *         name="filter[title]",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *           type="string",
     *           minLength=3
     *         )
     *     ),
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

    public function showAll(Request $request)
    {
        $term = null;
        if ($request->has('filter')) {
            $term = $request->input("filter.title");
        }

        if ($term) {
            $request = ['term'=>$term];
            $validator = Validator::make($request, [
                'term' => 'required|alpha_num'
            ]);

            try {
                if ($validator->fails()) {
                    // $validator->errors()
                    throw new InvalidTermException('Invalid high school term supplied: '.$term);
                }

                $useCase = new FindHighSchoolsUseCase($this->highSchoolsRepository);
                $request = new FindHighSchoolsRequest($term);
                $results = $useCase->find($request);

                if (! $results) {
                    throw new NoHighSchoolsFoundException('No high schools found for term: '.$term);
                } else {
                    return response()->json($results);
                }
            } catch (InvalidTermException $e) {
                $e->report($e->getMessage());
                return $e->render();
            } catch (NoHighSchoolsFoundException $e) {
                $e->report($e->getMessage());
                return $e->render();
            }
        } else {
            try {
                $useCase = new GetHighSchoolsUseCase($this->highSchoolsRepository);
                $all = $useCase->all();

                if (! $all) {
                    throw new NoHighSchoolsException('No active high schools found');
                } else {
                    return response()->json($all);
                }
            } catch (NoHighSchoolsException $e) {
                $e->report($e->getMessage());
                return $e->render();
            }
        }
    }

    /**
     * @OA\Get(
     *     path="/landmarks-api/high-schools/{slug}",
     *     description="Return a single high school by slug",
     *     @OA\Parameter(
     *         description="Slug of high school to return",
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
     *         description="High school not found"
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
                throw new InvalidSlugException('Invalid high school slug supplied: '.$slug);
            }

            $useCase = new GetHighSchoolUseCase($this->highSchoolsRepository);
            $request = new GetHighSchoolRequest($slug);
            $one = $useCase->show($request);

            if (! $one) {
                throw new UnrecognizedSlugException('High school not found: '.$slug);
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
