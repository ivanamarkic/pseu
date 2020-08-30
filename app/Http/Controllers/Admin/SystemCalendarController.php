<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\smijer;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\\App\\Event',
            'date_field' => 'start_time',
            'date_field_end' => 'end_time',
            'field'      => 'name',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.events.edit',
        ],
    ];

    public function index()
    {
        $events = [];

        $smijerovi = smijer::all();

        foreach ($this->sources as $source) {
            $calendarEvents = $source['model']::when(request('smijer_id') && $source['model'] == '\App\Event', function($query) {
                return $query->where([['smijer_id', request('smijer_id')],['godina',request('godina_id')]]);
            })->get();
            foreach ($calendarEvents as $model) {
                $crudFieldValue = $model->getOriginal($source['date_field']);
                $crudFieldValueEnd = $model->getOriginal($source['date_field_end']);

                if (!$crudFieldValue) {
                    continue;
                }
                if (!$crudFieldValueEnd) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'end'   => $crudFieldValueEnd,
                    'allDay'=> False,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events', 'smijerovi'));
    }
}
