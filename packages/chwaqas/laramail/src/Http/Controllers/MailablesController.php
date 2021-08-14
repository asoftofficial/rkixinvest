<?php

namespace Chwaqas\Laramail\Http\Controllers;

use Chwaqas\Laramail\Laramail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

class MailablesController extends Controller
{
    public function __construct()
    {
        abort_unless(
            App::environment(config('laramail.allowed_environments', ['local'])),
            403,
            'Environment Not Allowed'
      );
    }

    public function toMailablesList()
    {
        return redirect()->route('mailableList');
    }

    public function index()
    {
        $mailables = Laramail::getMailables();

        $mailables = (null !== $mailables) ? $mailables->sortBy('name') : collect([]);

        return view(Laramail::VIEW_NAMESPACE.'::sections.mailables', compact('mailables'));
    }

    public function generateMailable(Request $request)
    {
        return Laramail::generateMailable($request);
    }

    public function viewMailable($name)
    {
        $mailable = Laramail::getMailable('name', $name);

        if ($mailable->isEmpty()) {
            return redirect()->route('mailableList');
        }

        $resource = $mailable->first();

        return view(Laramail::VIEW_NAMESPACE.'::sections.view-mailable')->with(compact('resource'));
    }

    public function editMailable($name)
    {
        $templateData = Laramail::getMailableTemplateData($name);

        if (! $templateData) {
            return redirect()->route('viewMailable', ['name' => $name]);
        }

        return view(Laramail::VIEW_NAMESPACE.'::sections.edit-mailable-template', compact('templateData', 'name'));
    }

    public function parseTemplate(Request $request)
    {
        $template = $request->has('template') ? $request->template : false;

        $viewPath = $request->has('template') ? $request->viewpath : base64_decode($request->viewpath);

        // ref https://regexr.com/4dflu
        $bladeRenderable = preg_replace('/((?!{{.*?-)(&gt;)(?=.*?}}))/', '>', $request->markdown);

        if (Laramail::markdownedTemplateToView(true, $bladeRenderable, $viewPath, $template)) {
            return response()->json([
                'status' => 'ok',
            ]);
        }

        return response()->json([
            'status' => 'error',
        ]);
    }

    public function previewMarkdownView(Request $request)
    {
        return Laramail::previewMarkdownViewContent(false, $request->markdown, $request->name, false, $request->namespace);
    }

    public function previewMailable($name)
    {
        return Laramail::renderMailable($name);
    }

    public function delete(Request $request)
    {
        $mailableFile = config('laramail.mailables_dir').'/'.$request->mailablename.'.php';

        if (file_exists($mailableFile)) {
            unlink($mailableFile);

            return response()->json([
                'status' => 'ok',
            ]);
        }

        return response()->json([
            'status' => 'error',
        ]);
    }

    public function sendTest(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'email|nullable',
            'name' => 'string|required',
        ]);

        $email = $request->get('email') ?? config('laramail.test_mail');

        Laramail::sendTest($request->get('name'), $email);
    }
}
