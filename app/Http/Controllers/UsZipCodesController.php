<?php

namespace App\Http\Controllers;

use App\Http\GetUsZipCodeRequest;
use App\Interactors\GetUsZipCodesUseCase;
use App\Interactors\GetUsZipCodeUseCase;
use App\Repositories\CachingMysqlUsZipCodesRepository;
use App\Http\GetUsStateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use App\Exceptions\NoUsZipCodesException;
use App\Exceptions\InvalidUsZipCodeException;
use App\Exceptions\UnrecognizedUsZipCodeException;

class UsZipCodesController extends Controller
{
    protected $usZipCodesRepository;

    public function __construct()
    {
        $this->usZipCodesRepository = new CachingMysqlUsZipCodesRepository();
    }

    /**
     * @OA\Get(
     *     path="/landmarks-api/us-zip-codes",
     *     description="Return all US zip codes",
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
        $useCase = new GetUsZipCodesUseCase($this->usZipCodesRepository);
        $all = $useCase->all();

        try {
            if (! $all) {
                throw new NoUsZipCodesException('No active US zip codes found');
            } else {
                return response()->json($all);
            }
        } catch (NoUsZipCodesException $e) {
            $e->report($e->getMessage());
            return $e->render();
        }
    }

    /**
     * @OA\Get(
     *     path="/landmarks-api/us-zip-codes/{zip_code}",
     *     description="Return information for a single US zip code",
     *     @OA\Parameter(
     *         description="US zip code",
     *         in="path",
     *         name="zip_code",
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
     *         description="Invalid US zip code supplied"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="US zip code not found"
     *     ),
     * )
     */

    public function showOne($zip_code = null)
    {
        $request = ['zip_code'=>$zip_code];
        $validator = Validator::make($request, [
            'zip_code' => 'required|alpha_dash'
        ]);

        try {
            if ($validator->fails()) {
                // $validator->errors()
                throw new InvalidUsZipCodeException('Invalid US zip code supplied: '.$zip_code);
            }

            $useCase = new GetUsZipCodeUseCase($this->usZipCodesRepository);
            $request = new GetUsZipCodeRequest($zip_code);
            $one = $useCase->show($request);

            if (! $one) {
                throw new UnrecognizedUsZipCodeException('US zip code not found: '.$zip_code);
            } else {
                return response()->json($one);
            }
        } catch (InvalidUsZipCodeException $e) {
            $e->report($e->getMessage());
            return $e->render();
        } catch (UnrecognizedUsZipCodeException $e) {
            $e->report($e->getMessage());
            return $e->render();
        }
    }
}
