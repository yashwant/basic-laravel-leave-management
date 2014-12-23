<?php

class Leave extends \Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'leaves';
    protected $fillable = array('user_id', 'start', 'end', 'status');

    public static $rejected = 3;
    public static $approved = 2;
    public static $applied = 1;
    
    // DEFINE RELATIONSHIPS
    public function user()
    {
        return $this->belongsTo('User');
    }

}
