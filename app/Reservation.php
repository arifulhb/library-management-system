<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;
    use Carbon\Carbon;

    class Reservation extends Model
    {

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'reservations';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['date', 'book_copy_id', 'member_id', 'dueDate', 'returnStatus', 'returnDate', 'fine'];

        /**
         * The attributes that should be mutated to dates.
         *
         * @var array
         */
        protected $dates = ['deleted_at', 'dueDate', 'date', 'returnDate'];

        public function member()
        {
            return $this->belongsTo('App\User', 'member_id', 'id');
        }

        public function bookCopy()
        {
            return $this->belongsTo('App\BookCopy', 'book_copy_id', 'id');
        }

        public function fine()
        {

            $now = Carbon::now();
            if ($now->lt($this->dueDate)) {
                return 0;
            } else {
                $diffInDays = $this->dueDate->diffInDays($now);

                return $diffInDays * 2;
            }
        }

        public function getDueDate()
        {
            $now = Carbon::now();
            $diffInDays = $this->dueDate->diffInDays($now);
            if ($now->lt($this->dueDate)) {
                return 'In ' . $diffInDays . ' days';
            } else {
                return $diffInDays . ' days passed';
            }
        }

    }
