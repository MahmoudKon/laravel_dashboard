<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;
use App\Models\Email;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    public function count() // get count of emails not seen for authentcation user
    {
        return Email::seen(EMAIL_UNSEEN)->count();
    }

    public function list(Request $request) // list emails in notification icon
    {
        $emails = Email::filter()->with('notifier', 'recipients')->paginate(6);
        $next_page = $emails->currentPage() < $emails->lastPage()
                        ? "{$emails->path()}?page=".($emails->currentPage() + 1)
                        : null;

        return response()->json([
            'emails' => view('backend.emails.includes.single-email', compact('emails'))->render(),
            'next_page' => $next_page
        ]);
    }

    public function new($limit = 1)
    {
        $emails = Email::current(EMAIL_UNSEEN)->with('notifier', 'recipients')->limit($limit)->get();
        return response()->json([
            'emails' => view('backend.emails.includes.single-email', compact('emails'))->render(),
        ]);
    }

    public function index()
    {
        if (request()->ajax())
            return $this->show(request()->email);
        return view('backend.emails.index');
    }

    public function create()
    {
        return view('backend.includes.forms.form-create', ['use_form_ajax' => true, 'users' => User::pluck('email')->toArray()]);
    }

    public function store(EmailRequest $request)
    {
        createEmail($request->validated());
        return response()->json(['message' => trans('flash.row created', ['model' => trans('menu.email')]), 'icon' => 'success']);
    }

    public function show($id)
    {
        $email = Email::with('notifier', 'recipients', 'attachments')->find($id);
        if (!$email) return;
        $email->updateSeen();

        $view = null;
        if($email->view && $email->model) {
            $model = app($email->model);
            $models = app($email->model)::relations()->whereIn('id', explode(',', $email->ids))->get();
            foreach ($models as $model) {
                $view .= view($email->view, ['note' => $model])->render();
            }
        }
        return view('backend.emails.includes.content', compact('email', 'view'));
    }

    public function destroy($id)
    {
        try {
            $email = Email::find($id);
            $email->recipients()->detach(auth()->id());
            toast(trans('flash.row deleted', ['model' => trans('menu.email')]), 'success');
            return response()->json(['reload' => true]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function read()
    {
        foreach (Email::seen(EMAIL_UNSEEN)->get() as $email) {
            DB::beginTransaction();
                $email->updateSeen();
            DB::commit();
        }

        return redirect()->back();
    }
}
