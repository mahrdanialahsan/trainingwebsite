<?php

namespace App\Http\Controllers\Concerns;

use HotwiredLaravel\TurboLaravel\Facades\TurboStream;

trait RespondsWithTurboStreams
{
    /**
     * Check if request expects Turbo Stream response
     */
    protected function wantsTurboStream(): bool
    {
        return request()->wantsTurboStream();
    }

    /**
     * Return appropriate response (Turbo Stream or redirect)
     */
    protected function turboStreamResponse($action, $model, $message = null, $redirectRoute = null)
    {
        if ($this->wantsTurboStream()) {
            return TurboStream::response()
                ->$action($model)
                ->append('flash-messages', view('components.flash-message', [
                    'type' => 'success',
                    'message' => $message ?? ucfirst($action) . ' completed successfully.'
                ]));
        }

        return redirect($redirectRoute ?? request()->header('Turbo-Frame', route('admin.courses.index')))
            ->with('success', $message ?? ucfirst($action) . ' completed successfully.');
    }
}
