<?php

namespace App\Imports;

use App\Enums\EmployeeContractType;
use App\Enums\WorkModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\AfterSheet;



class UsersImport implements ToModel, WithValidation, WithStartRow, WithEvents
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user =  User::create([
            'first_name' => $row[0],
            'middle_name' => $row[1] ?? '',
            'last_name' => $row[2],
            'email' => $row[3],
            'password' => Hash::make('test1234'),
            'phone' => $row[4],
            'gender' => $row[5],
            'dob' => $row[6],
            'date_of_hire' => $row[7],
            'position' => $row[8],
            'nationality' => $row[9],
            'civil_status' => $row[10],
            'highest_educational_attainment' => $row[11],
            'is_employee_onboarded' => true,
            'city' => $row[12],
            'country' => $row[13],
            'contract_type' => EmployeeContractType::fromKey($row[14]),
            'work_model' => WorkModel::fromKey($row[15]),
        ]);

        $user->assignRole('employee');


        return $user;
    }

    public function rules(): array
    {
        return [
            '0' => 'required|min:2',
            '1' => 'nullable',
            '2' => 'required',
            '3' => ['required', 'email', 'unique:users,email'],
            '4' => 'required|string',
            '5' => 'required|string',
            '6' => 'nullable|date_format:Y-m-d',
            '7' => 'required|date_format:Y-m-d',
            '8' => 'nullable|string|max:255',
            '9' => 'nullable|string|max:255',
            '10' => 'nullable|string|max:255',
            '11' => 'nullable|string|max:255',
            '12' => 'required|string',
            '13' => 'required',
            '14' => 'required',
            '15' => 'required',
        ];
    }

    public function prepareForValidation($data, $index)
    {
        $data[6] = $this->transformDate($data[6]);
        $data[7] = $this->transformDate($data[7]);
        if (!!strlen($data[14])) {
            $data[14] = str_replace(' ', '', $data[14]);
        }
        if (!!strlen($data[15])) {
            $data[15] = str_replace(' ', '', $data[15]);
        }


        return $data;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterImport::class => function (AfterImport $event) {
                // Log::debug('After import ----------');

                // dd($event);
            },


            AfterSheet::class => function (AfterSheet $event) {
                // Log::debug('After sheet ----------');
                // dd($event);
            },

        ];
    }


    public function startRow(): int
    {
        return 2;
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        if (!strlen($value)) return null;

        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format('Y-m-d');
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
}
