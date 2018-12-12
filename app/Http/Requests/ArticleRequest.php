<?php

namespace Corp\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->canDo('ADD_ARTICLES');
    }

    protected function getValidatorInstance(){
       $validator=parent::getValidatorInstance();

        $validator->sometimes('alias','unique:articles|max:255',function ($input){
            return !empty($input['alias']);
        });

        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()

    {


        return [
            'title'=>'required|max:255',
            'text'=>'required',
            'category_id'=>'required|integer'

        ];
    }
}
