<?php

namespace HessamDev\Hessam\Requests;


use Illuminate\Validation\Rule;
use HessamDev\Hessam\Requests\Traits\HasCategoriesTrait;
use HessamDev\Hessam\Requests\Traits\HasImageUploadTrait;

class CreateHessamPostRequest extends BaseHessamPostRequest
{
    use HasCategoriesTrait;
    use HasImageUploadTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $return = $this->baseBlogPostRules();
        $return['slug'] [] = Rule::unique("hessam_posts", "slug");
        return $return;
    }

}
