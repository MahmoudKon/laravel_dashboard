<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AnnouncementDataTable;
use App\Http\Controllers\BackendController;
use App\Models\Announcement;
use App\Http\Services\AnnouncementService;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementController extends BackendController
{
    public $use_form_ajax = true;
    public $view_sub_path = '.';

    public function store(AnnouncementRequest $request, AnnouncementService $AnnouncementService)
    {
        $row = $AnnouncementService->handle($request->validated());
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.announcement')]), routeHelper('announcements.show', $row));
    }

    public function update(AnnouncementRequest $request, AnnouncementService $AnnouncementService, $id)
    {
        $row = $AnnouncementService->handle($request->validated(), $id);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.announcement')]), routeHelper('announcements.show', $row));
    }

    public function model() { return new Announcement; }

    public function dataTable() { return new AnnouncementDataTable; }
}
