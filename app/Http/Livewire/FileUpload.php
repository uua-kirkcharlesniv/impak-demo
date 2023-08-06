<?php

namespace App\Http\Livewire;

use App\Imports\UsersImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class FileUpload extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $file;
    public $fileErrors = [];

    public function render()
    {
        return view('livewire.file-upload');
    }


    public function save()
    {
        $this->fileErrors = [];

        Log::debug('validating file');

        $this->validate([
            'file' => 'max:6000|required'
        ]);

        Log::debug('file validated, now processing import...');
        try {

            Excel::import(new UsersImport, $this->file);

            $this->reset();

            $this->alert('success', 'Employees added!');

            Log::debug('import completed');

            $is_employee_onboarded = Auth::user()->is_employee_onboarded;
            if ($is_employee_onboarded == false || $is_employee_onboarded == 0) {
                Auth::user()->update([
                    'is_employee_onboarded' => true
                ]);
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];

            foreach ($failures as $failure) {
                array_push($errors, 'Validation error on row ' . (intval($failure->row()) - 1) . ', column: ' . (intval($failure->attribute() + 1)));
            }

            $this->fileErrors = $errors;
        }
    }
}
