<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BookCopy extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books_copies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['bookCode', 'status', 'book_id', 'added_by'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function book(){
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }

    public function addedBy(){
        return $this->belongsTo('App\User', 'added_by', 'id');
    }

    public function reservations(){

        return $this->hasMany('App\Reservation', 'book_copy_id', 'id');

    }

/*    public function getStatusAttribute($value){
        if($value == 1 ){
            return 'Available';
        } elseif ($value == 0){
            return 'Borrowed';
        }
    }*/

    /*
     * Generate code of individual books
     * @TODO add first category code in bookCode. make real serial number
     */
    public function generateBookCode($shelfName, $shelfRackLevel){
        $shelf = explode(' ', $shelfName);
        return substr($shelf[0], 0, 2) . substr($shelf[1], 0, 1).'-' . $shelfRackLevel . '-'.rand(10,99);
    }
}
