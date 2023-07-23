<?php

namespace App\Imports;

use App\Models\Akastrat\DailyVocabulary;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DailyVocabularyImport implements WithMultipleSheets
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function sheets(): array 
    {
        return [
            'Kata Benda' => new NounSheetImport(),
            'Kata Kerja' => new VerbSheetImport(),
            'Ungkapan Harian' => new DailyExpressionSheetImport()
        ];
    }
}
