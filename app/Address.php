<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['add_line_1', 'add_line_2', 'town', 'postcode'];


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
