<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BioController extends Controller
{
    public function index()
    {
        $bios = Bio::orderBy('type')->orderBy('name')->get();
        return view('admin.bios.index', compact('bios'));
    }

    public function create()
    {
        return view('admin.bios.create');
    }

    public function store(Request $request)
    {
        $this->logPhotoUploadAttempt('BioController@store', $request);

        try {
            $uploadMax = ini_get('upload_max_filesize');
            $validated = $request->validate([
                'type' => 'required|in:owner,partner',
                'name' => 'required|string|max:255',
                'tagline' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'credentials' => 'nullable|string',
                'experience' => 'nullable|string',
                'is_active' => 'boolean',
            ], [
                'photo.image' => 'The photo must be an image (JPEG, PNG, or GIF).',
                'photo.max' => 'The photo may not be greater than 5 MB.',
                'photo.uploaded' => 'The photo could not be uploaded. Your file may exceed the server limit (' . $uploadMax . '). Please use a smaller image (under ' . $uploadMax . ') or ask your host to increase upload_max_filesize in php.ini.',
            ]);

            $validated['is_active'] = $request->boolean('is_active', true);

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('bios', 'public');
                $validated['photo'] = $path;
                Log::info('Bio photo uploaded (create)', ['path' => $path, 'storage_disk' => 'public']);
            }

            Bio::create($validated);

            return redirect()->route('admin.bios.index')
                ->with('success', 'Bio created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Bio create validation failed', [
                'errors' => $e->errors(),
                'photo_related' => $e->validator->errors()->has('photo'),
            ]);
            throw $e;
        } catch (\Throwable $e) {
            Log::error('Bio create failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    public function edit(Bio $bio)
    {
        return view('admin.bios.edit', compact('bio'));
    }

    public function update(Request $request, Bio $bio)
    {
        $this->logPhotoUploadAttempt('BioController@update', $request, $bio->id);

        try {
            $uploadMax = ini_get('upload_max_filesize');
            $validated = $request->validate([
                'type' => 'required|in:owner,partner',
                'name' => 'required|string|max:255',
                'tagline' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'credentials' => 'nullable|string',
                'experience' => 'nullable|string',
                'is_active' => 'nullable|boolean',
            ], [
                'photo.image' => 'The photo must be an image (JPEG, PNG, or GIF).',
                'photo.max' => 'The photo may not be greater than 5 MB.',
                'photo.uploaded' => 'The photo could not be uploaded. Your file may exceed the server limit (' . $uploadMax . '). Please use a smaller image (under ' . $uploadMax . ') or ask your host to increase upload_max_filesize in php.ini.',
            ]);

            if ($request->hasFile('photo')) {
                if ($bio->photo && Storage::disk('public')->exists($bio->photo)) {
                    Storage::disk('public')->delete($bio->photo);
                }
                $path = $request->file('photo')->store('bios', 'public');
                $validated['photo'] = $path;
                Log::info('Bio photo uploaded (update)', ['bio_id' => $bio->id, 'path' => $path]);
            } else {
                $validated['photo'] = $bio->photo;
            }

            $validated['is_active'] = $request->boolean('is_active', true);
            $bio->update($validated);

            return redirect()->route('admin.bios.index')
                ->with('success', 'Bio updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Bio update validation failed', [
                'bio_id' => $bio->id,
                'errors' => $e->errors(),
                'photo_related' => $e->validator->errors()->has('photo'),
            ]);
            throw $e;
        } catch (\Throwable $e) {
            Log::error('Bio update failed', [
                'bio_id' => $bio->id,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    /**
     * Log detailed info about the request when a photo upload is attempted.
     */
    protected function logPhotoUploadAttempt(string $action, Request $request, ?int $bioId = null): void
    {
        $hasFile = $request->hasFile('photo');
        $logContext = [
            'action' => $action,
            'http_method' => $request->method(),
            'content_type' => $request->header('Content-Type'),
            'has_file_photo' => $hasFile,
            'all_files' => array_keys($request->allFiles()),
        ];
        if ($bioId !== null) {
            $logContext['bio_id'] = $bioId;
        }

        if ($hasFile) {
            $file = $request->file('photo');
            $logContext['photo'] = [
                'client_name' => $file->getClientOriginalName(),
                'size_bytes' => $file->getSize(),
                'size_kb' => round($file->getSize() / 1024, 2),
                'mime_type' => $file->getMimeType(),
                'upload_error' => $file->getError(),
                'upload_error_message' => $this->uploadErrorMessage($file->getError()),
            ];
            $logContext['storage_public_writable'] = is_writable(Storage::disk('public')->path(''));
            $logContext['storage_public_path'] = Storage::disk('public')->path('');
        } else {
            $contentLength = $request->header('Content-Length');
            $uploadMax = ini_get('upload_max_filesize');
            $postMax = ini_get('post_max_size');
            $logContext['reason'] = 'No file in request under key "photo". Possible causes: form missing enctype="multipart/form-data", input name not "photo", or request body/file too large (check post_max_size/upload_max_filesize).';
            $logContext['post_max_size'] = $postMax;
            $logContext['upload_max_filesize'] = $uploadMax;
            $logContext['request_content_length'] = $contentLength;
            if ($contentLength && $uploadMax) {
                $logContext['likely_cause'] = 'Photo or request body exceeds PHP upload_max_filesize (' . $uploadMax . '). Increase upload_max_filesize (and post_max_size if needed) in php.ini.';
            }
        }

        Log::info('Bio photo upload attempt', $logContext);
    }

    protected function uploadErrorMessage(int $code): string
    {
        $messages = [
            UPLOAD_ERR_OK => 'No error',
            UPLOAD_ERR_INI_SIZE => 'File exceeds upload_max_filesize',
            UPLOAD_ERR_FORM_SIZE => 'File exceeds MAX_FILE_SIZE in form',
            UPLOAD_ERR_PARTIAL => 'File was only partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary folder',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
            UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the upload',
        ];
        return $messages[$code] ?? "Unknown error code {$code}";
    }

    public function destroy(Bio $bio)
    {
        if ($bio->photo && Storage::disk('public')->exists($bio->photo)) {
            Storage::disk('public')->delete($bio->photo);
        }
        $bio->delete();

        return redirect()->route('admin.bios.index')
            ->with('success', 'Bio deleted successfully.');
    }
}
