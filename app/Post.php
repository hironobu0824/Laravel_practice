<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    
    public function categories()
    {
        return $this->belongsToMany('App\category');
    }
    
    public function getCommentsPaginate()
    {
        return $this->comments()->orderBy('updated_at','DESC')->paginate(5);
    }
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
        return $this->orderBy('updated_at','DESC')->paginate($limit_count);
    }
    
    public function createWithRelation($input)
    {
        try{
            $post = $this->create($input);
            $post->categories()->attach($input['categories']);
            return $post;
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
        
    }
    
    public function updateWithRelation($input)
    {
        try{
            $post = $this->findOrFainl($id);
            $post->fill($input)->save();
            $post->categories()->sync($input['categories']);
            return $post;
        } catch (Exception $e){
            throw new Exception($e->getMessage());
        }
        
    }
    
    public function deleteWithRelation()
    {
        try{
            $post = $this->findOrFainl($id);
            $post->comments()->delete();
            $post->categories()->detach();
            $post->delete();
        }catch(\Exception $e){
            throw new Exception($e->getMessage());
        }
    }
}

