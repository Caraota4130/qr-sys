<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QrCode
 * 
 * @property int $id
 * @property string $name
 * @property string $content
 * @property string $color
 * @property string $background_color
 * @property int $size
 * @property int $scans
 * @property bool $active
 * @property int $user_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class QrCode extends Model
{
	use SoftDeletes;
	protected $table = 'qr_codes';

	protected $casts = [
		'size' => 'int',
		'scans' => 'int',
		'active' => 'bool',
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'content',
		'color',
		'background_color',
		'size',
		'scans',
		'active',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
