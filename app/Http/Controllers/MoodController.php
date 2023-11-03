<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required|numeric|between:1,5',
            'journal' => 'nullable|string|max:1024',
        ]);

        $user = Auth::user();

        $data = Mood::create([
            'mood' => $request->input('mood'),
            'journal' => $request->input('journal'),
            'user_id' => $user->id,
        ]);

        return response()->json(['message' => 'Resource created', 'data' => $data]);
    }

    public function timeline()
    {
        $user = Auth::user();

        $data = Mood::where('user_id', $user->id)
            ->get()
            ->groupBy(function ($model) {
                return Carbon::parse($model->created_at)->setTimezone('Asia/Manila')->format('m/d/y');
            });

        return response()->json(['data' => $data]);
    }

    public function personalAnalyticsWeekly()
    {
        $user = Auth::user();

        $startDate = Carbon::now()->setTimezone('Asia/Manila')->startOfWeek();

        $entries = Mood::where('user_id', $user->id)
            ->whereBetween('created_at', [
                $startDate,
                Carbon::now()->setTimezone('Asia/Manila')->endOfWeek(),
            ])->get();

        $weeklyAverage = $entries->avg('mood');

        $grouped = $entries->groupBy(function ($model) {
            return Carbon::parse($model->created_at)->setTimezone('Asia/Manila')->format('m/d/y');
        });

        $week = [];
        for ($i = 0; $i < 7; $i++) {
            $key = Carbon::now()->setTimezone('Asia/Manila')->startOfWeek()->addDay($i)->format('m/d/y');
            if ($grouped->has($key)) {
                $week[$key] = $this->invertAverage(round($grouped[$key]->avg('mood') * 20));
            } else {
                $week[$key] = 0;
            }
        }

        $message = '';
        $parsedWeeklyAverage = $this->invertAverage(round($weeklyAverage * 20));
        if ($parsedWeeklyAverage >= 0 && $parsedWeeklyAverage <= 20) {
            $message = 'Stress is a signal that it\'s time to slow down and take care of yourself.';
        } else if ($parsedWeeklyAverage > 20 && $parsedWeeklyAverage <= 40) {
            $message = 'You\'ve been feeling stressed lately. It\'s okay; we all have those days.';
        } else if ($parsedWeeklyAverage > 40 && $parsedWeeklyAverage <= 60) {
            $message = 'Take time for self-reflection, and enjoy your day.';
        } else if ($parsedWeeklyAverage > 60 && $parsedWeeklyAverage <= 80) {
            $message = 'Your calmness is a reflection of your inner strength. Keep it up!';
        } else if ($parsedWeeklyAverage > 80 && $parsedWeeklyAverage <= 100) {
            $message = 'Your very calmness if a testament to your inner balance and resillience.';
        }

        return response()->json([
            'average' => $parsedWeeklyAverage,
            'days' => $week,
            'message' => $message,
        ]);
    }

    public function personalAnalyticsMonthly()
    {
        $user = Auth::user();

        $startDate = Carbon::now()->setTimezone('Asia/Manila')->startOfMonth();
        $endDate = Carbon::now()->setTimezone('Asia/Manila')->endOfMonth();

        $startWeek = intval($startDate->format('W'));
        $endWeek = intval($endDate->format('W'));

        $entries = Mood::where('user_id', $user->id)
            ->whereBetween('created_at', [
                $startDate,
                $endDate,
            ])->get();

        $monthlyAverage = $entries->avg('mood');

        $parsedMonthlyAverage = $this->invertAverage(round($monthlyAverage * 20));

        $grouped = $entries->groupBy(function ($model) {
            return Carbon::parse($model->created_at)->setTimezone('Asia/Manila')->format('W');
        });

        $diff = $endWeek - $startWeek;

        $week = [];
        for ($i = 0; $i <= $diff; $i++) {
            $key = Carbon::now()->setTimezone('Asia/Manila')->startOfMonth()->addWeek($i)->format('W');
            if ($grouped->has($key)) {
                $week['Week ' . $key] = $this->invertAverage(round($grouped[$key]->avg('mood') * 20));
            } else {
                $week['Week ' . $key] = 0;
            }
        }

        $message = '';

        if ($parsedMonthlyAverage >= 0 && $parsedMonthlyAverage <= 20) {
            $message = 'Stress is a signal that it\'s time to slow down and take care of yourself.';
        } else if ($parsedMonthlyAverage > 20 && $parsedMonthlyAverage <= 40) {
            $message = 'You\'ve been feeling stressed lately. It\'s okay; we all have those days.';
        } else if ($parsedMonthlyAverage > 40 && $parsedMonthlyAverage <= 60) {
            $message = 'Take time for self-reflection, and enjoy your day.';
        } else if ($parsedMonthlyAverage > 60 && $parsedMonthlyAverage <= 80) {
            $message = 'Your calmness is a reflection of your inner strength. Keep it up!';
        } else if ($parsedMonthlyAverage > 80 && $parsedMonthlyAverage <= 100) {
            $message = 'Your very calmness if a testament to your inner balance and resillience.';
        }

        return response()->json([
            'average' => $parsedMonthlyAverage,
            'days' => $week,

            'message' => $message,
        ]);
    }

    protected function invertAverage($value)
    {
        return 100 - $value + 0;
    }
}
