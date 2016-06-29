<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'publishers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'establishYear', 'country', 'phone', 'email', 'website'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    public function books(){
        return $this->hasMany('App\Book', 'publisher_id', 'id');
    }

    public function getWebsiteAttribute($value){

        $website = str_replace('http://www.', '', $value);
        $website = str_replace('https://www.', '', $website);
        return $website;

    }
    
}
