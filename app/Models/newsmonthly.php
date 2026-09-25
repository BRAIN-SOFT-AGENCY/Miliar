<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class newsmonthly extends Model
{
    protected $table = 'newsmonthly';

    protected $primaryKey = 'idnewsmonthly';

    public $timestamps = false;

    protected $fillable = [
        'year',
        'month',
        'pdf',
        'picture',
        'title',
    ];

    public static function monthNames(): array
    {
        return [
            1 => 'يناير',
            2 => 'فبراير',
            3 => 'مارس',
            4 => 'أبريل',
            5 => 'مايو',
            6 => 'يونيو',
            7 => 'يوليو',
            8 => 'أغسطس',
            9 => 'سبتمبر',
            10 => 'أكتوبر',
            11 => 'نوفمبر',
            12 => 'ديسمبر',
        ];
    }

    public function getMonthNameAttribute(): string
    {
        return self::monthNames()[(int) $this->month] ?? '';
    }
}