<?php

namespace HessamDev\Hessam\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use HessamDev\Hessam\Events\CommentApproved;
use HessamDev\Hessam\Events\CommentWillBeDeleted;
use HessamDev\Hessam\Helpers;
use HessamDev\Hessam\Middleware\UserCanManageBlogPosts;
use HessamDev\Hessam\Models\HessamComment;

/**
 * Class HessamCommentsAdminController
 * @package HessamDev\Hessam\Controllers
 */
class HessamCommentsAdminController extends Controller
{
    /**
     * HessamCommentsAdminController constructor.
     */
    public function __construct()
    {
        $this->middleware(UserCanManageBlogPosts::class);
    }

    /**
     * Show all comments (and show buttons with approve/delete)
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $comments = HessamComment::withoutGlobalScopes()->orderBy("created_at", "desc")
            ->with("post");

        if ($request->get("waiting_for_approval")) {
            $comments->where("approved", false);
        }

        $comments = $comments->paginate(100);
        return view("hessam_admin::comments.index")
            ->withComments($comments
            );
    }


    /**
     * Approve a comment
     *
     * @param $blogCommentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($blogCommentId)
    {
        $comment = HessamComment::withoutGlobalScopes()->findOrFail($blogCommentId);
        $comment->approved = true;
        $comment->save();

        Helpers::flash_message("Approved!");
        event(new CommentApproved($comment));

        return back();

    }

    /**
     * Delete a submitted comment
     *
     * @param $blogCommentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($blogCommentId)
    {
        $comment = HessamComment::withoutGlobalScopes()->findOrFail($blogCommentId);
        event(new CommentWillBeDeleted($comment));

        $comment->delete();

        Helpers::flash_message("Deleted!");
        return back();
    }


}
