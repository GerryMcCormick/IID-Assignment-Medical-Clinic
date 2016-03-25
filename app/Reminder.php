<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reminders';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['desc'];

    

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
