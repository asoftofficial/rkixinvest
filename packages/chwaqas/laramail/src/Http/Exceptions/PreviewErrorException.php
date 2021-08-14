<?php

namespace Chwaqas\Laramail\Http\Exceptions;

use Exception;
use Laramail\Facades\Laramail;

class PreviewErrorException extends Exception
{
    /**
     * The error exception.
     *
     * @var string
     */
    protected $exception;

    /**
     * Create a new preview exception.
     */
    public function __construct($exception)
    {
        $this->exception = $exception;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()
            ->view(
                Laramail::VIEW_NAMESPACE.'::previewerror',
                ['exception' => $this->exception],
                500
            );
    }
}
