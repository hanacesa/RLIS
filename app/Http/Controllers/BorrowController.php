<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Borrow::query();

        if ($search) {
            $query->where('book_id', $search)
                  ->orWhereHas('member', function ($q) use ($search) {
                      $q->where('ic', $search);
                  });
        }

        $borrows = $query->with(['member', 'book'])->get();

        return view('borrow.index', compact('borrows'));
    }

    public function create($member_id, $book_id)
    {
        $member = Member::findOrFail($member_id);
        $book = Book::findOrFail($book_id);
        return view('borrow.create', compact('member_id', 'book_id', 'member', 'book'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
        ]);

        // Check if the book is already borrowed by any member
        $existingBorrow = Borrow::where('book_id', $validated['book_id'])
            ->whereNull('returndate')
            ->first();

        if ($existingBorrow) {
            return redirect()->back()->with('error', 'The book is already borrowed by another member.');
        }

        // Create a new borrow record
        Borrow::create([
            'member_id' => $validated['member_id'],
            'book_id' => $validated['book_id'],
            'borrowdate' => now(),
            'returndate' => null,
        ]);

        // Update the book status to 'borrowed'
        $book = Book::findOrFail($validated['book_id']);
        $book->status = 'borrowed';
        $book->save();

        return redirect()->route('borrow.index')->with('success', 'Book borrowed successfully.');
    }

    public function borrowBook(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
        ]);

        // Check if the book is already borrowed by another member
        $existingBorrow = Borrow::where('book_id', $validated['book_id'])
            ->whereNull('returndate')
            ->first();

        if ($existingBorrow) {
            return redirect()->back()->with('error', 'Book is already borrowed by another member.');
        }

        // Create a new borrow record
        Borrow::create([
            'member_id' => $validated['member_id'],
            'book_id' => $validated['book_id'],
            'borrowdate' => now(),
        ]);

        // Update the book status to 'borrowed'
        $book = Book::findOrFail($validated['book_id']);
        $book->status = 'borrowed';
        $book->save();

        return redirect()->route('borrow.index')->with('success', 'Book borrowed successfully.');
    }

    public function returnBook(Request $request)
    {
        $borrowId = $request->input('borrow_id');

        // Find the borrow record
        $borrow = Borrow::findOrFail($borrowId);

        // Update the returndate
        $borrow->returndate = now();
        $borrow->save();

        // Update the book status to 'available'
        $book = Book::findOrFail($borrow->book_id);
        $book->status = 'available';
        $book->save();

        return redirect()->back()->with('success', 'Book returned successfully.');
    }

    public function showBooks(Request $request)
    {
        $member_id = $request->query('member_id');
        $books = Book::all();
        return view('book.index', compact('books', 'member_id'));
    }

    public function show(Member $member)
    {
        $borrowedBooks = $member->borrows()->with('book')->get();
        return view('member.show', compact('member', 'borrowedBooks'));
    }

    public function edit(Borrow $borrow)
    {
        return view('borrow.edit', compact('borrow'));
    }

    public function update(Request $request, Borrow $borrow)
    {
        // Update the borrow record
        $borrow->member_id = $request->input('member_id');
        $borrow->book_id = $request->input('book_id');
        $borrow->borrowdate = $request->input('borrowdate');
        $borrow->returndate = $request->input('returndate');
        $borrow->update();

        // If a return date is set, update the book's status
        if ($borrow->returndate) {
            $book = Book::findOrFail($borrow->book_id);
            $book->status = 'available';
            $book->save();
        }

        return redirect()->route('borrow.index')->with('success', 'Borrow record updated successfully.');
    }

    public function destroy(Borrow $borrow)
    {
        // Update the book status to 'available' before deleting the borrow record
        $book = Book::findOrFail($borrow->book_id);
        $book->status = 'available';
        $book->save();

        $borrow->delete();

        return redirect()->route('borrow.index')->with('success', 'Borrow record deleted successfully.');
    }
}
