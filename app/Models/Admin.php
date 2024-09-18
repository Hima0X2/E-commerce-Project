<?php

// app/Models/Admin.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    // Specify the table if it's not the default "admins"
    protected $table = 'admins';

    // If using a different column for the primary key or if it's not auto-incrementing
    protected $primaryKey = 'id';
    public $incrementing = true;

    // Add other properties or methods if needed
}
