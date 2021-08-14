<?php

namespace Chwaqas\Laramail\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Laramail\Facades\Laramail;
use Chwaqas\Laramail\Http\Exceptions\PreviewErrorException;

class MailablesPreviewController extends Controller
{
    public function __construct()
    {
        abort_unless(
            App::environment(config('laramail.allowed_environments', ['local'])),
            403
        );
    }

    public function previewError()
    {
        return view(Laramail::VIEW_NAMESPACE.'::previewerror');
    }

    public function markdownView(Request $request)
    {
        return Laramail::previewMarkdownViewContent(false, $request->markdown, $request->name, false, $request->namespace);
    }

    public function mailable($name)
    {
        $mailable = Laramail::getMailable('name', $name);

        if ($mailable->isEmpty()) {
            return redirect()->route('mailableList');
        }

        $resource = $mailable->first();

        if (collect($resource['data'])->isEmpty()) {
            return 'View not found';
        }

        $instance = Laramail::handleMailableViewDataArgs($resource['namespace']);

        if (is_null($instance)) {
            $instance = new $resource['namespace'];
        }

        $view = ! is_null($resource['markdown'])
            ? $resource['markdown']
            : $resource['data']->view;

        if (view()->exists($view)) {
            try {
                $html = $instance;

                return $html->render();
            } catch (\ErrorException $e) {
                throw new PreviewErrorException($e);
            }
        }

        throw new PreviewErrorException(new \Exception('No template associated with this mailable.'));
    }
}
