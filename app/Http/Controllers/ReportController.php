<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\View;
    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use App\Reservation;
    use App\BookCopy;
    use App\Book;

    class ReportController extends Controller
    {

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
        }

        public function getLoan(Request $request)
        {

            $inputs = $request->all();
            $data= [];

            if (isset($inputs['start']) && isset($inputs['end'])) {
                $startDate = date('Y-m-d', strtotime($inputs['start']));
                $endDate = date('Y-m-d', strtotime($inputs['end']));
                $reservations = Reservation::where(function ($query) use ($startDate, $endDate) {

                    $query->where(function ($query) use ($startDate) {
                        $query->where('date', '>=', $startDate . ' 00:00:00');
                    });
                    $query->where(function ($query) use ($endDate) {
                        $query->where('date', '<=', $endDate . '23:59:59');
                    });
                })->get();

                $data['reservations'] = $reservations;
            }

            return View::make('admin.report.loan' , $data);
        }

        public function getReturn(Request $request)
        {

            $inputs = $request->all();
            $data= [];

            if (isset($inputs['start']) && isset($inputs['end'])) {
                $startDate = date('Y-m-d', strtotime($inputs['start']));
                $endDate = date('Y-m-d', strtotime($inputs['end']));
                $return= Reservation::where(function ($query) use ($startDate, $endDate) {

                    $query->where(function ($query) use ($startDate) {
                        $query->where('returnDate', '>=', $startDate . ' 00:00:00');
                    });
                    $query->where(function ($query) use ($endDate) {
                        $query->where('returnDate', '<=', $endDate . '23:59:59');
                    });
                })->get();

                $data['returns'] = $return;
            }

            return View::make('admin.report.return' , $data);
        }

        public function getBalance(Request $request)
        {

            $books = Book::has('copies')->get();
            $data['books']= $books;

            return View::make('admin.report.balance' , $data);
        }

    }