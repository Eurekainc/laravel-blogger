<?php

namespace HessamDev\Hessam\Requests;


use Illuminate\Validation\Rule;
use HessamDev\Hessam\Models\HessamPost;
use HessamDev\Hessam\Requests\Traits\HasCategoriesTrait;
use HessamDev\Hessam\Requests\Traits\HasImageUploadTrait;

class UpdateHessamPostRequest  extends BaseHessamPostRequest {

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
        $return['slug'] [] = Rule::unique("hessam_posts", "slug")->ignore($this->route()->parameter("blogPostId"));
        return $return;
    }
}
