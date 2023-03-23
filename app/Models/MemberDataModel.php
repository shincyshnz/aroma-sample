<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberDataModel extends Model
{
    protected $table = 'member_details';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'name',
        'designation',
        'email',
        'memberPhoneCode',
        'memberPhone',
        'location',
        'file'
    ];
}
