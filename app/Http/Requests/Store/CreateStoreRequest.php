<?php

declare(strict_types=1);

namespace App\Http\Requests\Store;

use App\Constants\Regex;
use App\Constants\Role;
use App\Http\Requests\BaseRequest;
use App\Services\Interfaces\IAuthorizationService;

class CreateStoreRequest extends BaseRequest
{

    public function __construct(private IAuthorizationService $authorizationService)
    {
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->authorizationService->isUserAuthorized(Role::MERCHANT->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|regex:' . Regex::ALLOW_ENGLISH_SPECIAL_CHARACTERS_NUMBERS,
        ];
    }
}
