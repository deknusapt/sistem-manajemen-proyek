<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Material;
use App\Models\Client;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        // Data untuk chart projects berdasarkan status
        $projectsByStatus = Project::select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // Data untuk chart materials availability
        $materialsAvailability = [
            'available' => Material::where('availability', 'available')->count(),
            'out_of_stock' => Material::where('availability', 'out_of_stock')->count(),
        ];

        // Total clients
        $totalClients = Client::count();

        // Users dengan role Engineer yang aktif dalam project
        $activeEngineers = User::whereHas('projects', function ($query) {
            $query->where('status', 'active');
        })->where('role', 'Engineer')->count();

        // Summary data
        $doneProjects = Project::where('status', 'done')->where('updated_at', '>=', now()->subDays(7))->count();
        $createdProjects = Project::where('created_at', '>=', now()->subDays(7))->count();
        $updatedProjects = Project::where('updated_at', '>=', now()->subDays(7))->count();
        $dueProjects = Project::where('end_date', '<', now())->count();

        return view('reports.index', compact(
            'projectsByStatus',
            'materialsAvailability',
            'totalClients',
            'activeEngineers',
            'doneProjects',
            'createdProjects',
            'updatedProjects',
            'dueProjects'
        ));
    }
}
