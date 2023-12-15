<?php

namespace App\Listeners;

use App\Events\SurveyPublished;
use App\Models\QuestionQuant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use MattDaneshvar\Survey\Models\Answer;

class GenerateQuantifiableData
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SurveyPublished  $event
     * @return void
     */
    public function handle(SurveyPublished $event)
    {
        $survey = $event->survey;
        if ($survey->publish_status != "closed") {
            return false;
        }

        foreach ($survey->questions as $question) {
            $questionId = $question->id;

            $data = Answer::select('value')->selectRaw('COUNT(*) as count')->where('question_id', $questionId)->groupBy('value')->get();
            $dataset = $data->pluck('count', 'value')->toArray();

            $labels = [];
            $compiled = [];

            $mean = -1;
            $median = -1;
            $mode = -1;
            $stddev = 0;

            if ($question->type == 'range') {
                foreach (range(1, 10) as $option) {
                    array_push($labels, $option);

                    if (array_key_exists($option, $dataset)) {
                        array_push($compiled, $dataset[$option]);
                    } else {
                        array_push($compiled, 0);
                    }
                }

                $dataset = array_combine($labels, $compiled);
                $data = $compiled;

                // Mean 
                $mean = array_sum($data) / count($data);
                $values = array_values($data);
                $count = count($values);
                $middle = floor(($count - 1) / 2);

                if ($count % 2 == 0) {
                    $median = ($values[$middle] + $values[$middle + 1]) / 2;
                } else {
                    $median = $values[$middle];
                }

                // Step 4: Calculate the mode
                $counts = array_count_values($values);
                arsort($counts);
                $mode = key($counts);

                $variance = 0;
                foreach ($data as $value) {
                    $variance += pow($value - $mean, 2);
                }
                $stddev = sqrt($variance / count($data));

                $data = $dataset;
            } elseif ($question->type == 'radio') {
                $order = array_flip($question->options);
                $dataArray = $dataset;

                foreach ($order as $key => $value) {
                    if (!array_key_exists($key, $dataArray)) {
                        $dataArray[$key] = 0;
                    }
                }

                uksort($dataArray, function ($a, $b) use ($order) {
                    return ($order[$a] <=> $order[$b]);
                });

                $dataset = $dataArray;

                $data = $dataset;

                // Mean
                $mean = array_sum($data) / count($data);

                // Median
                $count = count($data);
                $middle = floor(($count - 1) / 2);
                $keys = array_keys($data);

                if ($count % 2 == 0) {
                    $median = ($data[$keys[$middle]] + $data[$keys[$middle + 1]]) / 2;
                } else {
                    $median = $data[$keys[$middle]];
                }

                // Mode
                $counts = array_count_values($data);
                arsort($counts);
                $mode = key($counts);

                $variance = 0;
                foreach ($data as $value) {
                    $variance += pow($value - $mean, 2);
                }
                $stddev = sqrt($variance / count($data));
            }

            Log::info(json_encode([
                'type' => $question->type,
                'mean' => $mean,
                'median' => $median,
                'mode' => $mode,
                'stddev' => $stddev,
                'data' => $data,
            ]));

            QuestionQuant::updateOrCreate([
                'question_id' => $questionId
            ], [
                'mean' => $mean,
                'median' => $median,
                'mode' => $mode,
                'zscore' => $stddev,
                'dataset' => json_encode($data),
            ]);
        }
    }
}
