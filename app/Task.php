<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\User;
class Task extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];
    /**
     * The attributes that should be mutated to tasks
     *
     * @var array
     */
    protected $tasks = ['deleted_at'];

    public function users(){
        return $this->belongsToMany('App\User')->withPivot('status');
    }
    public function feedbacks()
    {
        return $this->hasMany('App\Feedback');
    }
}
