<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'date_of_birth',
        'city_id',
        'gender',
        'origin',
        'is_vip',
        'send_notifications',
        'last_message_sent_at',
    ];

    protected $casts = [
        'is_vip' => 'boolean',
        'send_notifications' => 'boolean',
        'date_of_birth' => 'date',
        'last_message_sent_at' => 'datetime',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getShortNameAttribute()
    {
        return preg_replace("/\s.*/", '', $this->name) . ' ' . preg_replace('/.*\s/', '', $this->name);
    }

    public function getBirthdayAttribute()
    {
        return ($this->date_of_birth) ? Carbon::parse($this->date_of_birth)->year(now()->format('Y'))->format('Y-m-d') : null;
    }
}
