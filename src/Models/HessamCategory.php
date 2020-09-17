<?php

namespace HessamDev\Hessam\Models;

use Illuminate\Database\Eloquent\Model;
use HessamDev\Hessam\Baum\Node;

class HessamCategory extends Node
{
    protected $parentColumn = 'parent_id';
    public $siblings = array();

    public $fillable = [
        'category_name',
        'slug',
        'category_description',
        'parent_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(HessamPost::class, 'blog_etc_post_categories');
    }

    /**
     * Returns the public facing URL of showing blog posts in this category
     * @return string
     */
    public function url()
    {
        $theChainString = "";
        $chain = $this->getAncestorsAndSelf();
        foreach ($chain as $category){
            $theChainString .=  "/" . $category->slug;
        }
        return route("hessam.view_category", $theChainString);
    }

    /**
     * Returns the URL for an admin user to edit this category
     * @return string
     */
    public function edit_url()
    {
        return route("hessam.admin.categories.edit_category", $this->id);
    }

    public function loadSiblings(){
        $this->siblings = $this->children()->get();
    }

//    public function parent()
//    {
//        return $this->belongsTo('HessamDev\Hessam\Models\HessamCategory', 'parent_id');
//    }
//
//    public function children()
//    {
//        return $this->hasMany('HessamDev\Hessam\Models\HessamCategory', 'parent_id');
//    }
//
//    // recursive, loads all descendants
//    private function childrenRecursive()
//    {
//        return $this->children()->with('children')->get();
//    }
//
//    public function loadChildren(){
//        $this->childrenCat = $this->childrenRecursive();
//    }

//    public function scopeApproved($query)
//    {
//        dd("A");
//        return $query->where("approved", true);
//    }
}
