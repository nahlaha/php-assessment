<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Constants\Regex;
use App\Constants\Role;
use App\Http\Requests\BaseRequest;
use App\Services\Interfaces\IAuthorizationService;

class CreateUserRequest extends BaseRequest
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
        return $this->authorizationService->isUserAuthorized(Role::ADMIN->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255|regex:' . Regex::ALLOW_ENGLISH_SPECIAL_CHARACTERS_NUMBERS,
            'last_name' => 'nullable|max:255|regex:' . Regex::ALLOW_ENGLISH_SPECIAL_CHARACTERS_NUMBERS,
            'email' => 'required|email',
            'password' => 'required|regex:' . Regex::PASSWORD,
            'role_id' => 'required|in:' . implode(',', array_column(Role::cases(), 'value')),
        ];
    }
}
