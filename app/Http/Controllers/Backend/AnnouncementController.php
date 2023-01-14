<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AnnouncementDataTable;
use App\Http\Controllers\BackendController;
use App\Models\Announcement;
use App\Http\Services\AnnouncementService;
use App\Http\Requests\AnnouncementRequest;
use Exception;

class AnnouncementController extends BackendController
{
    public bool $use_form_ajax = true;

    public function store(AnnouncementRequest $request, AnnouncementService $AnnouncementService)
    {
        $row = $AnnouncementService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.announcement')]), routeHelper('announcements.show', $row));
    }

    public function update(AnnouncementRequest $request, AnnouncementService $AnnouncementService, $id)
    {
        $row = $AnnouncementService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.announcement')]), routeHelper('announcements.show', $row));
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new Announcement; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new AnnouncementDataTable; }
}
