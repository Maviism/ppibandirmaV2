<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DailyVocabularyImport;
use App\Models\Akastrat\DailyVocabulary;


class DailyVocabularyController extends Controller
{
    

    public function index()
    {
        $vocabs = DailyVocabulary::where('is_posted', 0)->get();
        $sentVocabs = DailyVocabulary::where('is_posted', 1)->get();
        $nouns = $vocabs->where('type', 'noun');
        $verbs = $vocabs->where('type', 'verb');
        $expressions = $vocabs->where('type', 'expression');
        return view('admin.akastrat.daily-vocabulary', compact('nouns', 'verbs', 'expressions', 'sentVocabs'));
    }
    
    public function importExcel(Request $request)
    {
        $validatedData = $request->validate([
            'vocabFile' => 'required|mimes:xlsx'
        ]);
        Excel::import(new DailyVocabularyImport, $request->file('vocabFile'));

        return back();
    }

    public function destroy($id)
    {
        $vocab = DailyVocabulary::find($id);
        if(!$vocab){
            return response()->json(['message' => 'vocabulary not found'], 404);
        }

        $vocab->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Vocabulary deleted successfully'
        ]);
    }

}
