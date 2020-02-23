<?php

namespace App\prosvujusmev\EmailMessages;

use Illuminate\Database\Eloquent\Model;

class EmailMessage extends Model
{
    protected $table = 'email_messages';

    protected $fillable = [
        'id',
        'type',
        'data',
        'view',
        'model_id',
        'model_type',
    ];

    const TYPE_FIRST_INFORMATION = 'FIRST_INFORMATION';
    const TYPE_FINAL_INFORMATION = 'FINAL_INFORMATION';

    const VIEW_FIRST_INFORMATION = 'FIRST_INFORMATION';
    const VIEW_FINAL_INFORMATION = 'FINAL_INFORMATION';

    protected $viewMap = [
        self::VIEW_FIRST_INFORMATION => 'mails.courses.first_information',
        self::VIEW_FINAL_INFORMATION => 'mails.courses.final_information',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}