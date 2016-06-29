<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'authors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'gender', 'dateOfBirth', 'shortBio', 'country',
        'email' ,'twitter', 'website'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'dateOfBirth'];
    
    public function books(){
        return $this->belongsToMany('App\Book', 'author_book', 'author_id', 'book_id');
    }

    public function getWebsiteAttribute($value){

        $website = str_replace('http://www.', '', $value);
        $website = str_replace('https://www.', '', $website);
        return $website;

    }
}
