<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'patients';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'user_id', 'address_id', 'doctor_id', 'phone', 'dob', 'reminder_id'];

    
	public function doctor() {
		return $this->hasOne(Doctor::class);
	}
	public function appointments() { 
		return $this->belongsToMany(Appointment::class);
	}
	public function user() {
		return $this->belongsTo(User::class);
	}
	public function reminder() {
		return $this->hasOne(Reminder::class);
	}
	public function address() {
		return $this->hasOne(Address::class);
	}

    /**
     * Override the delete to perform cleanup
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
    	// delete the item
    	return parent::delete();
    }

}
