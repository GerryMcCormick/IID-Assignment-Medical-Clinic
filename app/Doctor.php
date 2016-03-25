<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'doctors';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'forename', 'surname', 'qualifications', 'image', 'about'];

    public function appointments() {
        return $this->belongsToMany(Appointment::class);
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
