<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }   

    public function index()
    {

    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function update()
    {
        
    }

    public function destroy()
    {
        
    }
}
