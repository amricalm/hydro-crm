<?php

namespace App\Http\Livewire;

use App\Models\Activity;
use Livewire\Component;

class ActivityChartMounthly extends Component
{
    public $activity;
    public function mount()
    {
        $activity = Activity::latest()->limit(10)->get();
        foreach ($activity as $rows) {
            $data['label'][] = $rows->date;
            $data['data'][] = (int) $rows->sales_id;
        }
        $this->activity = json_encode($data);
    }

    public function render()
    {
        return view('livewire.activity-chart-mounthly');
    }
}
