<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CalendarController extends Controller
{
    public function index(): JsonResponse
    {
        $tours = Tour::query()->with('batches', 'schedules', 'invoices');

        if (auth()->user()->role === GUIDE) {
            $tours = $tours->ofGuide();
        }

        $tours = $tours->get();
        $res_tours = [];
        foreach ($tours as $key => $tour) {
            foreach ($tour->batches as $batch) {
                array_push($res_tours, static::generate($tour, $batch));
            }
        }

        return response()->json($res_tours);
    }

    public function generate($tour, $batch): array
    {
        if (Carbon::parse($tour->getEndAt($batch))->greaterThan(now())) {
            if ($tour->invoices->count() > 0) {
                $desc = 'Đã có khách đặt, đang đợi xuất phát';
                $class = 'fc-event-danger fc-event-solid-warning';
            } else {
                $desc = 'Chưa có khách nào đặt';
                $class = 'fc-event-light fc-event-solid-info';
            }
        } elseif (Carbon::parse(now())->greaterThanOrEqualTo($tour->getStartAt($batch)) && Carbon::parse($tour->getEndAt($batch))->greaterThanOrEqualTo(now())) {
            $desc = 'Tour đang di chuyển';
            $class = 'fc-event-danger fc-event-solid-danger';
        } else {
            $desc = 'Đã hoàn thành hoặc quá thời gian';
            $class = 'fc-event-success fc-event-solid-secondary';
        }

        return [
            'title' => auth()->user()->role === ADMIN
                        ? Str::limit($tour->name) . ' - ' . $tour->guide->getFullName()
                        : Str::limit($tour->name),
            'start' => Carbon::parse($tour->getStartAt($batch))->format('Y-m-d'),
            'end' => Carbon::parse($tour->getEndAt($batch))->format('Y-m-d'),
            'description' => $desc,
            'url' => route('invoice.listUsers', ['id' => $tour->id]),
            'className' => $class
        ];
    }
}
