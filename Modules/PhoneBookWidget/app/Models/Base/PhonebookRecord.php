<?php

/**
 * Created by Reliese Model.
 */

namespace Modules\PhoneBookWidget\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PhonebookRecord
 *
 * @property int $id
 * @property string $fio
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string|null $post
 * @property string|null $administration_body_name
 * @property string|null $management_department
 *
 * @package App\Models\Base
 */
class PhonebookRecord extends Model
{
	protected $table = 'phone_book_widget_phonebook_records';
	public $timestamps = false;
}
