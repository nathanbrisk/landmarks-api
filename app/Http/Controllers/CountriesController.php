<?php

namespace App\Http\Controllers;

use App\Interactors\GetCountriesUseCase;
use App\Interactors\GetCountryUseCase;
use App\Repositories\CachingMysqlCountriesRepository;
use App\Http\GetCountryRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Exceptions\NoCountriesException;
use App\Exceptions\InvalidSlugException;
use App\Exceptions\UnrecognizedSlugException;

class CountriesController extends Controller
{
    protected $countriesRepository;

    public function __construct()
    {
        $this->countriesRepository = new CachingMysqlCountriesRepository();
    }

    /**
     * @OA\Get(
     *     path="/landmarks-api/countries",
     *     description="Return all countries",
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
        $useCase = new GetCountriesUseCase($this->countriesRepository);
        $all = $useCase->all();

        try {
            if (! $all) {
                throw new NoCountriesException('No active countries found');
            } else {
                return response()->json($all);
            }
        } catch (NoCountriesException $e) {
            $e->report($e->getMessage());
            return $e->render();
        }
    }

    /**
     * @OA\Get(
     *     path="/landmarks-api/countries/{slug}",
     *     description="Return a single country by slug",
     *     @OA\Parameter(
     *         description="Slug of country to return",
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
     *         description="Country not found"
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
                throw new InvalidSlugException('Invalid country slug supplied: '.$slug);
            }

            $useCase = new GetCountryUseCase($this->countriesRepository);
            $request = new GetCountryRequest($slug);
            $one = $useCase->show($request);

            if (! $one) {
                throw new UnrecognizedSlugException('Country not found: '.$slug);
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
