<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UploadEmployeeRequest;
use App\Service\EmployeeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct(private EmployeeService $employeeService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param int|null $department
     * @return View
     */
    public function index(Request $request, ?int $department = null): View
    {
        $data = $this->employeeService->index($request, $department);

        return view('employee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param UploadEmployeeRequest $request
     * @return RedirectResponse
     */
    public function upload(UploadEmployeeRequest $request): RedirectResponse
    {
        $this->employeeService->upload($request);

        return back();
    }
}
