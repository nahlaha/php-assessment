<?php


namespace App\Services;

use App\Constants\Error;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ResponseService
 * @package App\Services
 */
final class ResponseService
{

    /**
     * Gets a response object with the data returned to clients
     *
     * @param mixed $data
     * @return Illuminate\Http\Response
     */
    public function getSuccessResponse($data = "")
    {
        $result = array('data' => $data);
        return response()->json($result);
    }

    /**
     * Gets a response object for any error that occurs through out the application
     *
     * @param int $errorCode
     * @param int $responseCode
     * @param array $validationErrors
     * @return \Illuminate\Http\JsonResponse
     */
    public function getErrorResponse(int $errorCode, int $responseCode, $validationErrors = array())
    {
        $error = $this->getError($errorCode);
        $result = array('error' => $error);
        if (count($validationErrors) > 0) {
            $result['validation'] = $validationErrors;
        }
        return response()->json($result, $responseCode);
    }

    /**
     * Gets an array of error codes and their corresponding messages
     *
     * @param int $errorCode
     * @return array
     */
    private function getError(int $errorCode)
    {
        $error = Error::from($errorCode);
        return array('code' => $error->value, 'message' => $error->GetErrorMessage());
    }
}
