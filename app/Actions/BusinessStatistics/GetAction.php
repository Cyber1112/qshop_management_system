<?php

namespace App\Actions\BusinessStatistics;

use App\Contracts\GetBusinessStatistics;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Tasks;
use App\Helpers;
use Illuminate\Support\Facades\Auth;

class GetAction implements GetBusinessStatistics {

    protected $business_id;

    public function __construct()
    {
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(string $period): Collection
    {

        $data = app(Tasks\BusinessTransactionHistory\GetBusinessAllTransactionsTask::class)->run(
            $this->business_id,
            ['cash', 'created_at']
        );

        $data =  $this->convertDate($data);

        return match ($period) {
            'week' => $this->getByWeek($data),
            'month' => $this->getByMonth($data),
            'three month' => $this->getByThreeMonth($data),
            'half year' => $this->getByHalfYear($data),
            default => "",
        };
    }

    public function convertDate($data){
        $new_collection = collect();
        $data->map(function($item, $key) use ($new_collection){
            $new_collection->push([
                'cash' => $item['cash'],
                'created_at' => date('Y-m-d', strtotime($item['created_at']))
            ]);
        });
        return $new_collection;
    }

    public function getByWeek($data){

        $dayOfWeek = Carbon::now()->dayOfWeek;
        if ($dayOfWeek == 0){
            $dayOfWeek = 7;
        }

        return $data->filter(function($value) use($dayOfWeek){
            return $value['created_at'] > Carbon::now()->subDays($dayOfWeek);
        })->groupBy('created_at')->map(function($row, $key){
            return $row->sum('cash');
        });

    }

    public function getByMonth($data){

        $days = Carbon::now()->day;

        $filteredData = $data->filter(function($value) use ($days){
            return $value['created_at'] > Carbon::now()->subDays($days);
        })->groupBy('created_at')->map(function($row, $key){
            return $row->sum('cash');
        });

        $new_collection = collect();

        foreach ($filteredData as $key => $value){
            $day = Carbon::make($key)->day;
            if ( $day <= 5 ){
                if ($new_collection->has("5")){
                    $new_collection["5"] += $filteredData[$key];
                }else{
                    $new_collection->put("5", $filteredData[$key]);
                }
            }
            if ( $day > 5 && $day <= 10){
                if ($new_collection->has("10")){
                    $new_collection["10"] += $filteredData[$key];
                }else{
                    $new_collection->put("10", $filteredData[$key]);
                }
            }
            if ( $day > 10 && $day <= 15){
                if ($new_collection->has("15")){
                    $new_collection["15"] += $filteredData[$key];
                }else{
                    $new_collection->put("15", $filteredData[$key]);
                }
            }
            if ( $day > 15 && $day <= 20){
                if ($new_collection->has("20")){
                    $new_collection["20"] += $filteredData[$key];
                }else{
                    $new_collection->put("20", $filteredData[$key]);
                }
            }
            if ( $day > 20 && $day <= 25){
                if ($new_collection->has("25")){
                    $new_collection["25"] += $filteredData[$key];
                }else{
                    $new_collection->put("25", $filteredData[$key]);
                }
            }
            if ( $day > 25){
                if ($new_collection->has("30")){
                    $new_collection["30"] += $filteredData[$key];
                }else{
                    $new_collection->put("30", $filteredData[$key]);
                }
            }
        }
        return $new_collection;
    }

    public function getByThreeMonth($data){

        $filteredData = $data->filter(function($value){
            return $value['created_at'] > Carbon::now()->subMonth(3);
        })->map(function($row){
            return [
                'cash' => $row['cash'],
                'created_at' => date('M', strtotime($row['created_at']))
            ];
        })->groupBy('created_at')->map(function ($row){
            return $row->sum('cash');
        });

        return $filteredData;
    }

    public function getByHalfYear($data){
        $filteredData = $data->filter(function($value){
            return $value['created_at'] > Carbon::now()->subMonth(6);
        })->map(function($row){
            return [
                'cash' => $row['cash'],
                'created_at' => date('M', strtotime($row['created_at']))
            ];
        })->groupBy('created_at')->map(function ($row){
            return $row->sum('cash');
        });

        return $filteredData;
    }
}
