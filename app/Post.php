<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use SoftDeletes;
    
    const DEFAULT_PAGINATE_COUNT = 5;
    
    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class,'post_id');
    }
    
    public function getCommentsPaginate()
    {
        return $this->comments()->orderBy('updated_at', 'DESC')->paginate(self::DEFAULT_PAGINATE_COUNT);
    }
    
    public function getPaginateByLimit()
    {
        return $this->orderBy('updated_at', 'DESC')->paginate(self::DEFAULT_PAGINATE_COUNT);
    }
    
    public function createWithRelation($input)
    {
        try {
            $post = $this->create($input);
            $post->categories()->attach($input['categories']);
            return $post;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function updateWithRelation($input)
    {
        try {
            $this->fill($input)->save();
            $this->categories()->sync($input['categories']);
            return $this;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function deleteWithRelation()
    {
        try {
            $this->comments()->delete();
            $this->categories()->detach();
            $this->delete();
        } catch (\Exceptions $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function is_liked_by_auth_user()
    {
        $id = Auth::id();
        
        $likers = array();
        foreach($this->likes as $like) {
            array_push($likers,$like->user_id);
        }
        
        if (in_array($id,$likers)) {
            return true;
        } else {
            return false;
        }
    }
    
    
}
