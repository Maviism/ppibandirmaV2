<?php

namespace App\Imports;

use App\Models\Akastrat\DailyVocabulary;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');


class NounSheetImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        if (!empty($row['Kosa Kata']) && !empty($row['Makna'])){
            return new DailyVocabulary([
                'word_id' => $row['Kosa Kata'], 
                'word_tr' => $row['Makna'], 
                'type' => 'noun', 
            ]);
        }
    }

}
