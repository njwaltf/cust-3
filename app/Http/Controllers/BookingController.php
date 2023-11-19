<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Book;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'LP | Bookings';
    public function index()
    {
        return view('dashboard.bookings.index', [
            'bookings' => Booking::where('user_id', auth()->user()->id)->get(),
            'all_bookings' => Booking::latest()->get(),
            'title' => $this->title
            // 'result' => $result
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        $validatedData = $request->validate([
            'user_id' => ['required'],
            'book_id' => ['required'],
            'status' => ['required'],
            'isDenda' => ['required'],
            'stock' => ['required']
        ]);

        // $validatedData['expired_date'] = Carbon::now()->addDays(7);
        $validatedData['book_at'] = now();

        // $validatedData['user_id'] = auth()->user()->id;
        Booking::create($validatedData);
        // Book::where('id', $request->book_id)->update([
        //     'stock' => $request->stock - 1
        // ]);
        return redirect('/dashboard/bookings')->with('success', 'Peminjaman diajukan silahkan ambil buku anda ke perpustakaan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('dashboard.bookings.show', [
            'title' => $this->title,
            'booking' => $booking
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return view('dashboard.bookings.edit', [
            'title' => $this->title,
            'booking' => $booking
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        // edit booking
        $validatedData = $request->validate([
            'status' => ['required']
        ]);
        if ($validatedData['status'] === 'Approved') {
            // stock update
            Book::where('id', $booking->book_id)->update([
                'stock' => $booking->book->stock - 1
            ]);
            // create expired date
            $validatedData['expired_date'] = Carbon::now()->addDays(7);

        } elseif ($validatedData['status'] === 'Returned') {
            // Book stock update
            Book::where('id', $booking->book_id)->update([
                'stock' => $booking->book->stock + 1
            ]);
            // get today date
            $validatedData['return_date'] = Carbon::now();

            // check if the return_date is greater than the expired date if true denda == 1
            if ($validatedData['return_date']->gt($booking->expired_date)) {
                $validatedData['isDenda'] = 1;
                Book::where('id', $booking->book_id)->update([
                    'stock' => $booking->book->stock + 1
                ]);
            } else {
                $validatedData['isDenda'] = 0;
                Book::where('id', $booking->book_id)->update([
                    'stock' => $booking->book->stock + 1
                ]);
            }

        }
        // denda
        if ($validatedData['status'] === 'Dikembalikan Terlambat') {
            Booking::where('id', $booking->id)->update([
                'isDenda' => 1
            ]);
        }

        // status
        $booking = Booking::where('id', $booking->id)->update($validatedData);
        return redirect('/dashboard/bookings/')->with('successEdit', 'Booking successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
    public function exportPDF(Request $request)
    {
        $booking = Booking::all();
        $data['bookings'] = $booking;
        // $pdf = Pdf::loadView('pdf.qr', $book);
        // return $pdf->stream();
        $pdf = Pdf::loadView('pdf.bookings', $data);
        return $pdf->download(Carbon::now() . '_bookings_report.pdf');
    }
}
