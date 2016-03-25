<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'appointments';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['datetime', 'doctor_id', 'patient_id'];

    
	public function doctor() {
		return $this->belongsTo(Doctor::class);
	}
	public function patient() {
		return $this->belongsTo(Patient::class);
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
