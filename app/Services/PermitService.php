<?php


namespace App\Services;


use App\Permit;
use Illuminate\Support\Facades\Auth;

class PermitService
{
    protected $userId;
    protected $weekStart;
    protected $weekEnd;

    public function __construct()
    {
        $this->userId = Auth::id();
        $this->weekStart = date('Y-m-d', strtotime('monday this week'));
        $this->weekEnd = date('Y-m-d', strtotime('sunday this week'));
    }

    /**
     * @return bool
     */
    public function hasToday()
    {
        $permit = Permit::query()
            ->where('user_id', '=', $this->userId)
            ->where('visit', '=', date('Y-m-d'))
            ->first();
        return $permit instanceof Permit ? $permit->id : false;
    }

    /**
     * @return bool|\Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed
     */
    public function hasTomorrow()
    {
        $permit = Permit::query()
            ->where('user_id', '=', $this->userId)
            ->where('visit', '=', date('Y-m-d', strtotime('tomorrow')))
            ->first();
        return $permit instanceof Permit ? $permit->id : false;
    }

    public function limitWeek()
    {
        $weekUser = Permit::query()
            ->where('user_id', '=', $this->userId)
            ->where('visit', '>=', $this->weekStart)
            ->where('visit', '<=', $this->weekEnd)
            ->count()
        ;
        $limit = (int)config('params.setting.week_limit') - $weekUser;
        return $limit;
    }

    public function todayLimit()
    {
        $dayAll = Permit::query()
            ->where('visit', '=', date('Y-m-d'))
            ->count();
        return (int)config('params.setting.day_limit') - $dayAll;
    }

    public function tomorrowLimit()
    {
        $dayAll = Permit::query()
            ->where('visit', '=', date('Y-m-d', strtotime('tomorrow')))
            ->count();
        return (int)config('params.setting.day_limit') - $dayAll;
    }

    /**
     * @return bool
     */
    public function canToday()
    {
        if ($this->hasToday()) {
            return false;
        }
        if ($this->todayLimit() < 1) {
            return false;
        }
        if ($this->limitWeek() < 1) {
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    public function canTomorrow()
    {
        if ($this->hasTomorrow()) {
            return false;
        }
        if ($this->tomorrowLimit() < 1) {
            return false;
        }
        if ($this->limitWeek() < 1) {
            return false;
        }
        return true;
    }

    /**
     * @return mixed
     */
    public function setTomorrow()
    {
        $data = ['user_id' => $this->userId, 'visit' => date('Y-m-d', strtotime('tomorrow'))];
        $permit = new Permit($data);
        $permit->save();
        return $permit->id;
    }

    /**
     * @return mixed
     */
    public function setToday()
    {
        $data = ['user_id' => $this->userId, 'visit' => date('Y-m-d')];
        $permit = new Permit($data);
        $permit->save();
        return $permit->id;
    }

}
