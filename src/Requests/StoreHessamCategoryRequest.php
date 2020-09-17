<?php
namespace HessamDev\Hessam\Requests;


use Illuminate\Validation\Rule;

class StoreHessamCategoryRequest extends BaseHessamCategoryRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $return = $this->baseCategoryRules();
        $return['slug'] [] = Rule::unique("hessam_categories", "slug");
        return $return;
    }
}
