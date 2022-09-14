<?php

namespace App\Transformers;

use App\Models\Comment;
use App\Models\User;
use League\Fractal\TransformerAbstract;
use App\Transformers\UserTransformer;
use Carbon\Carbon;

class CommentTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];
    /**
     * @param Comment $comment
     * @return array
     */
    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'user_id' => $comment->user_id,
            'clinic_case_id' => $comment->clinic_case_id,
            'content' => $comment->content,
            'owner' => $comment->owner,
            'thumb_url' => $comment->thumb_url,
            'created_at' => $comment->created_at,
        ];
    }
}
