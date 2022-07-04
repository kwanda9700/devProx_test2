<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Data extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'surname', 'initial', 'age', 'date_of_birth'];

    public static function insertData($data)
    {

        $value = DB::table('csv_import')->where('name', $data['name'])->get();
        DB::table('csv_import')->insert($data);
    }
}
