<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class newsweekly extends Model
{
    protected $table = 'newsweekly';

    protected $primaryKey = 'idnewsweekly';

    public $timestamps = false;

    protected $fillable = [
        'year',
        'month',
        'week',
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

    public static function weekNames(): array
    {
        return [
            1 => 'الأسبوع الأول',
            2 => 'الأسبوع الثاني',
            3 => 'الأسبوع الثالث',
            4 => 'الأسبوع الرابع',
            5 => 'الأسبوع الخامس',
        ];
    }

    public function getweekNameAttribute(): string
    {
        return self::weekNames()[(int) $this->week] ?? '';
    }
}