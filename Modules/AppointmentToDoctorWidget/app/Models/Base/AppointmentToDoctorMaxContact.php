<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\AppointmentToDoctorWidget\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AppointmentToDoctorMaxContact
 *
 * @property int $id
 * @property string $user_id
 * @property string $phone
 * @property string|null $last_name
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class AppointmentToDoctorMaxContact extends Model
{
	protected $table = 'appointment_to_doctor_max_contacts';

    public $casts=[
      'user_id' => 'int'
    ];
}
