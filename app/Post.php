<?php

namespace App;

use Laravel\Scout\Searchable;

class Post extends Model
{
    use Searchable;
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'post';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    // 关联用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //评论模型
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    //和用户关联
    public function zan($user_id)
    {
        return $this->hasOne('App\Zan')->where('user_id',$user_id);
    }

    //文章所有赞
    public function zans()
    {
        return $this->hasMany('App\Zan');
    }
}
