<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Models\Visit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
class ChartController extends BaseController
{   
    protected $model;
    protected $nameItem;


    public function __construct()
    {
        parent::__construct('chart');
        // Set your model class here
        $this->model = new Visit();
        $this->nameItem = 'Biểu đồ';

        View::share('nameClass', 'chart');
    }
    public function index(Request $request){
        // Get the current month
        $currentMonth = Carbon::now()->format('m');

        // Retrieve visits for the current month
        $visits = $this->model::whereMonth('visit_date', $currentMonth)->get();
        $chartData = []; // Initialize an array to store data for the chart

        foreach ($visits as $visit) {
            // Convert access_date to Carbon object
        $visitDate = Carbon::parse($visit->visit_date);
            $chartData[] = [
                'date' => $visitDate->format('d-m-Y') ,
                'count' => $visit->visit_count,
            ];
        }
        $data['chartData'] = json_encode($chartData);

        $data['nameItem'] = $this->nameItem;
        return $this->view_admin('list', $data);
    }
}
