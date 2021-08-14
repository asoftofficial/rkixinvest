<?php

namespace Chwaqas\Laramail\Http\Controllers;

use Chwaqas\Laramail\Utils\TemplateSkeletons;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Laramail\Facades\Laramail;

class TemplatesController extends Controller
{
    public function __construct()
    {
        abort_unless(
            App::environment(config('laramail.allowed_environments', ['local'])),
            403,
            'Environment Not Allowed'
        );
    }

    public function index()
    {
        $skeletons = TemplateSkeletons::skeletons();

        $templates = Laramail::getTemplates();

        return View(Laramail::VIEW_NAMESPACE.'::sections.templates', compact('skeletons', 'templates'));
    }

    public function new($type, $name, $skeleton)
    {
        $type = $type === 'html' ? $type : 'markdown';

        $skeleton = TemplateSkeletons::get($type, $name, $skeleton);

        return View(Laramail::VIEW_NAMESPACE.'::sections.create-template', compact('skeleton'));
    }

    public function view($templateslug = null)
    {
        $template = Laramail::getTemplate($templateslug);

        if (is_null($template)) {
            return redirect()->route('templateList');
        }

        return View(Laramail::VIEW_NAMESPACE.'::sections.edit-template', compact('template'));
    }

    public function create(Request $request)
    {
        return Laramail::createTemplate($request);
    }

    public function select(Request $request)
    {
        $skeletons = TemplateSkeletons::skeletons();

        return View(Laramail::VIEW_NAMESPACE.'::sections.new-template', compact('skeletons'));
    }

    public function delete(Request $request)
    {
        if (Laramail::deleteTemplate($request->templateslug)) {
            return response()->json([
                'status' => 'ok',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
            ]);
        }
    }

    public function update(Request $request)
    {
        return Laramail::updateTemplate($request);
    }
}
