<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'isbn', 'publishDate', 'publishYear', 'status',
    'edition', 'publisher_id', 'bookCode', 'shelfName', 'shelfRackLevel', 'thumbnail'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'publishDate'];

    public function authors(){
        return $this->belongsToMany('App\Author', 'author_book', 'book_id', 'author_id');
    }

    public function categories(){
        return $this->belongsToMany('App\BookCategory', 'book_category', 'book_id', 'category_id');
    }

    public function publisher(){
        return $this->belongsTo('App\Publisher', 'publisher_id','id');
    }

    public function copies(){
        return $this->hasMany('App\BookCopy', 'book_id', 'id');
    }
    
}
