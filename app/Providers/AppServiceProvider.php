<?php

namespace App\Providers;

use App\Models\Question;
use App\Models\Section;
use App\Models\Survey;
use Illuminate\Support\ServiceProvider;
use Laravel\Paddle\Cashier;
use MattDaneshvar\Survey\Contracts\Section as SectionContract;
use MattDaneshvar\Survey\Contracts\Survey as SurveyContract;
use MattDaneshvar\Survey\Contracts\Question as QuestionContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();

        $this->app->bind(SectionContract::class, Section::class);
        $this->app->bind(SurveyContract::class, Survey::class);
        $this->app->bind(QuestionContract::class, Question::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
