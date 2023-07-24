<?php

namespace App\Http\Livewire\Admin\Video;

use App\Http\Livewire\BaseComponent;
use App\Repositories\StreamRepository;

class Create extends BaseComponent
{

    public $title, $description, $start_time, $end_time, $schedule_date, $recorded_video, $thumbnail;

    public $timeRangedAlreadyScheduled = [];

    public function updatedScheduleDate($value){
        $this->timeRangedAlreadyScheduled = StreamRepository::getTimeRangeAlreadyScheduled($value);

        $this->dispatchBrowserEvent("update-time-range", ['time_range' => $this->timeRangedAlreadyScheduled ]);
    }

    public function submit(){

        $this->validate([
            'title' => 'required|string',
            'description' => 'required|max:1500',
            'schedule_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'thumbnail' => 'required|image',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'recorded_video' => 'required|file|mimetypes:video/*|max:204800'
        ],[
            'schedule_date.*' => 'Invalid Date Selected',
            'start_time.*' => 'Invalid Start Time Selected',
            'end_time.required' => 'Invalid End Time Selected'
        ]);

        try {

            $acceptedTimeRange = StreamRepository::acceptedTimeRange($this->start_time, $this->end_time);

            throw_unless($acceptedTimeRange, "Streaming time must be within 5 minutes, 10, 20, 30 and 120 minutes");

            $data = [
                'title' => $this->title,
                'description' => $this->description,
                'schedule_date' => $this->schedule_date,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'recorded_video' => $this->recorded_video,
                'thumbnail' => $this->thumbnail
            ];

            throw_unless(StreamRepository::create($data), "Please try again");

            toast()->success('Cheer! Video has been added to stream pool!')->pushOnNextPage();

            return redirect()->route('admin.dashboard');

        } catch (\Throwable $e) {
            toast()->danger($e->getMessage())->push();
        }
    }

    public function render()
    {
        return view('livewire.admin.video.create')->layout('layouts.admin-base');
    }
}
