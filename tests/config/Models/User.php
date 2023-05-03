<?php

namespace Backpack\CRUD\Tests\Config\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use CrudTrait;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'extras'];

    /**
     * Get the account details associated with the user.
     */
    public function accountDetails()
    {
        return $this->hasOne('Backpack\CRUD\Tests\Config\Models\AccountDetails');
    }

    /**
     * Get the articles for this user.
     */
    public function articles()
    {
        return $this->hasMany('Backpack\CRUD\Tests\Config\Models\Article');
    }

    /**
     * Get the user roles.
     */
    public function roles()
    {
        return $this->belongsToMany('Backpack\CRUD\Tests\Config\Models\Role', 'user_role');
    }

    public function getNameComposedAttribute()
    {
        return $this->name.'++';
    }

    public function comment()
    {
        return $this->morphOne('Backpack\CRUD\Tests\Config\Models\Comment', 'commentable');
    }

    public function recommends()
    {
        return $this->morphToMany('Backpack\CRUD\Tests\Config\Models\Recommend', 'recommendable')->withPivot('text');
    }

    public function bills()
    {
        return $this->morphToMany('Backpack\CRUD\Tests\Config\Models\Bill', 'billable');
    }

    public function stars()
    {
        return $this->morphMany('Backpack\CRUD\Tests\Config\Models\Star', 'starable');
    }

    public function superArticles()
    {
        return $this->belongsToMany('Backpack\CRUD\Tests\Config\Models\Article', 'articles_user')->withPivot(['notes', 'start_date', 'end_date']);
    }

    public function universes()
    {
        return $this->hasMany('Backpack\CRUD\Tests\Config\Models\Universe');
    }

    public function planets()
    {
        return $this->hasMany('Backpack\CRUD\Tests\Config\Models\Planet');
    }

    public function planetsNonNullable()
    {
        return $this->hasMany('Backpack\CRUD\Tests\Config\Models\PlanetNonNullable');
    }

    public function comets()
    {
        return $this->hasMany('Backpack\CRUD\Tests\Config\Models\Comet');
    }

    public function bang()
    {
        return $this->belongsTo('Backpack\CRUD\Tests\Config\Models\Bang', 'bang_relation_field');
    }

    public function incomes()
    {
        return $this->hasMany('Backpack\CRUD\Tests\Config\Models\Transaction')->ofType('income');
    }

    public function expenses()
    {
        return $this->hasMany('Backpack\CRUD\Tests\Config\Models\Transaction')->ofType('expense');
    }

    protected function isNotRelation()
    {
        return false;
    }

    public function isNotRelationPublic($arg)
    {
        return false;
    }
}
