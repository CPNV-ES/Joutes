<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['username', 'first_name', 'last_name', 'password', 'role'];
    public $timestamps = false;
    protected $hidden = array('password');


    public function getRememberToken(){
    }
    public function setRememberToken($value){
    }
    public function getRole(){
        return $this->role;
    }

    public function participant()
    {
        return $this->hasOne('App\Participant');
    }

    public function teams()
    {
        /*
        $participant = Auth::user()->participant()->first();
        $teams = $participant->teams;
        return $teams;
        */
        return $this->belongsToMany('App\Team')->withPivot('isCaptain');


        //return $this->hasManyThrough('App\Team', 'App\Participant', 'team_id','user_id' );
    }

    public function tournaments() {
        // get event teams
        $teams = $this->teams;
        // create empty array for participants
        $tournaments = [];

        foreach ($teams as $team) {
            $tournaments[] = $team->tournament;
        }

        return collect($tournaments)->unique("id");
    }

    // Returns whether the user is locally authenticated or remotely (SAML)
    public function isLocal()
    {
        return !empty($this->password);
    }

    public function isUnsigned($id)
    {
        $participant = user::where('id',$id)->first();
        return (count ($participant->teams) < 2);
    }

}
