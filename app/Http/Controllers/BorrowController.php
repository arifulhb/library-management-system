<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookCopy;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Auth;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /**
         * Policy
         * 1. Full member can loan maximum 6 books at a time
         * 2. Junior Member can loan 3 books at a time
         * 3. Member more then 12 years old are full member
         * 4. any book can be borrow for maximum 2 full weeks [dueDate].
         * 5. After dueDate , $2 fine for each day.
         */


        $carbon = new Carbon();
        $dueDate = $carbon->addWeek(2)->format('d M, Y');
        $memberAge = Auth::user()->dateOfBirth->age;
        $data['dueDate'] = $dueDate;
        $data['currentLoan'] = Auth::user()->reservations()->count();

        if ($memberAge > JUNIOR_MEMBER_AGE_LIMIT) {
            /*
             * Full Member
             */
            $data['membership'] = 'Member';
            $data['maxLimitNow'] = FULL_MEMBER_BORROW_LIMIT - $data['currentLoan'];
        } else {
            if ($memberAge <= JUNIOR_MEMBER_AGE_LIMIT) {
                /**
                 * Junior Member
                 */
                $data['membership'] = 'Junior Member';
                $data['maxLimitNow'] = JUNIOR_MEMBER_BORROW_LIMIT - $data['currentLoan'];
            }
        }

        return View::make('browser.borrow.borrow', $data);
    }


    public function getReturn(){

        $reservations = Auth::user()->reservations();
        $data['reservations'] = $reservations;
        $data['today'] = date('l d M, Y', strtotime('now'));

        return View::make('browser.borrow.return', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs = $request->all();

        $validator = Validator::make($inputs, [
            'books'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()
                        ->json(['result'=>false], 422);
        } else {

        }
        $carbon = new Carbon();
        $dueDate = $carbon->addWeek(2)->format('Y-m-d');

        $ids = [];
        foreach($inputs['books'] as $book){
            $borrow = new Reservation();
            $borrow->member_id = Auth::user()->id;
            $borrow->date = $carbon->now();
            $borrow->book_copy_id = $book;
            $borrow->dueDate = $dueDate;
            $borrow->returnStatus = BOOK_RETURN_FALSE;
            $borrow->save();

            array_push($ids, $borrow->id);

            $bookCopy = BookCopy::find($book);
            $bookCopy->status = BOOK_COPY_STATUS_ON_LOAN;
            $bookCopy->save();
        }

        return response()
            ->json(['result' => $ids], 201);


    }

    public function postReturn(Request $request, $id){

        $inputs = $request->all();
        $reservation = Reservation::find($id);

        $reservation->returnDate = Carbon::now();
        $reservation->returnStatus = BOOK_RETURN_TRUE;
        $reservation->fine = $inputs['fine'];
        $reservation->save();

        /**
         * Update BookCopy Status
         */
        $bookCopy = BookCopy::find($reservation->bookCopy->id);
        $bookCopy->status = BOOK_COPY_STATUS_ACTIVE;
        $bookCopy->save();

        return response()
                ->json(['result'=>true], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
