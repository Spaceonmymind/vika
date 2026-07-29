<?php

namespace Modules\PhoneBookWidget\Models;

use Modules\PhoneBookWidget\Models\Base\PhonebookRecord as BasePhonebookRecord;

class PhonebookRecord extends BasePhonebookRecord
{
    protected $fillable = [
        'fio',
        'city',
        'phone',
        'email',
        'address',
        'post',
        'administration_body_name',
        'management_department',
        'od_api_id',
    ];
}
