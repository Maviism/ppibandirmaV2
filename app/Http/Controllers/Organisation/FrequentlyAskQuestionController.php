<?php

namespace App\Http\Controllers\Organisation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advokasi\FrequentlyAskQuestion;

class FrequentlyAskQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = FrequentlyAskQuestion::get();
        return view('admin.advokasi.faq', [
            'faqs' => $faqs
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
    public function store(Request $request)
    {
        $request->validate([
            'iQuestionNew' => 'required|string|max:255',
            'tAnswerNew' => 'required'
        ]);

        $lastSequence = FrequentlyAskQuestion::max('sequence') + 1;

        FrequentlyAskQuestion::create([
            'category' => 'General',
            'question' => $request->iQuestionNew,
            'answer' => $request->tAnswerNew,
            'sequence' => $lastSequence
        ]);

        return redirect('admin/faq');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'iQuestion' => 'required|string|max:255',
            'tAnswer' => 'required'
        ]);
        
        $faq = FrequentlyAskQuestion::find($id);
        
        $faq->update([
            'question' => $request->iQuestion,
            'answer' => $request->tAnswer
        ]);
        
        return redirect('admin/faq');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = FrequentlyAskQuestion::findOrFail($id);
        $faq->delete();

        return redirect('admin/faq');
    }
}
