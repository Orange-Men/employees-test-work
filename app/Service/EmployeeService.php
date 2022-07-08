<?php

declare(strict_types=1);

namespace App\Service;

use App\Http\Requests\UploadEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeService
{
    /**
     * @param Request $request
     * @param int|null $department
     *
     * @return array
     */
    public function index(Request $request, ?int $department = null): array
    {
        return [
            'employees' => Employee::query()
                ->when($department, fn ($query) => $query->where('department_id', $department))
                ->with('department')
                ->paginate($request->limit ?? Employee::DEFAULT_LIMIT),
            'departments' => Department::all(),
        ];
    }

    /**
     * @param UploadEmployeeRequest $request
     *
     * @return void
     */
    public function upload(UploadEmployeeRequest $request): void
    {
        $xmlObject = simplexml_load_file($request->file('file')->getRealPath());

        $jsonFormatData = json_encode($xmlObject);
        $result = json_decode($jsonFormatData, true);

        try {
            if (count($result['employee']) > 0) {
                $employees = [];

                foreach ($result['employee'] as $data) {
                    $employees[] = [
                        'name' => $data['name'],
                        'birthday' => $data['birthday'] ?? null,
                        'position' => $data['position'] ?? null,
                        'payment_type' => $data['payment_type'] ?? null,
                        'payment' => $data['payment'] ?? null,
                        'department_id' => $data['department_id'],
                    ];
                }

                Employee::query()->insert($employees);
            }
        } catch (\Exception $exception) {
            Log::error('An error in xml file. Data: ' . print_r($result, true));
            abort(400, 'An error in xml file.');
        }
    }
}
