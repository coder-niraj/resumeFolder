<?php

namespace Modules\Applications\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Applications\DTOs\CreateApplicationDTO;
use Modules\Applications\Repositories\ApplicationEloquent;
use Modules\Users\Models\Resumes;
use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\Text;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Element\Title;
use PhpOffice\PhpWord\Element\ListItem;
use Spatie\PdfToText\Pdf;



class ApplicationServices
{

    private $appRepo;
    public function __construct(ApplicationEloquent $appRepo)
    {
        $this->appRepo = $appRepo;
    }

    function extractPDF($path)
    {
        $pdfPath = Storage::disk('resumes')->path($path);
        /** @var \Illuminate\Http\Client\Response $response */
        $response = Http::attach(
            'file',
            fopen($pdfPath, 'r'),
            basename($pdfPath)
        )->post('https://resumetester.onrender.com');

        $data = $response->json();
        return $data['parsed_text'] ?? '';
    }

    function extractDOC($path)
    {
        $pdfPath = Storage::disk('resumes')->path($path);

        /** @var \Illuminate\Http\Client\Response $response */
        $response = Http::attach(
            'file',
            fopen($pdfPath, 'r'),
            basename($pdfPath)
        )->post('https://resumetester.onrender.com');

        $data = $response->json();

        return $data['parsed_text'] ?? '';
    }
    function extractSkills($skills, $text)
    {
        $foundSkills = [];
        foreach ($skills as $skill) {
            if (str_contains($text, strtolower($skill))) {
                $foundSkills[] = $skill;
            }
        }
    }
    function storeResumeService($resume, $application, $userId)
    {
        $extension = strtolower($resume->getClientOriginalExtension());
        $filename = Str::uuid() . '.' . $resume->extension();
        $path = $resume->storeAs(
            $application->id,
            $filename,
            'resumes'
        );
        $text = "";
        if ($extension == "pdf") {
            $text = $this->extractPDF($path);
        } else {
            $text = $this->extractDoc($path);
        }
        $resume = Resumes::create([
            'application_id' => $application->id,
            'user_id' => $userId,
            'parsed_data' => $text,
            'file_path' => $path,
            'original_name' => $resume->getClientOriginalName(),
            'mime_type' => $resume->getClientMimeType(),
            'file_size' => $resume->getSize(),
        ]);
        return $resume;
    }
    public function getApplicationList($id)
    {
        $application = $this->appRepo->getApplicationLists($id);
        return $application;
    }
    function getResumeDetails() {}
    function createApplicationService(CreateApplicationDTO $applicationDTO, $id)
    {
        $application = $this->appRepo->createApplicationDemo([
            'job_posting_id' => $applicationDTO->job_posting_id,
            'expected_ctc' => $applicationDTO->expected_ctc,
            'cover_letter' => $applicationDTO->cover_letter,
        ], $id);
        if ($application) {

            $resume = $this->storeResumeService($applicationDTO->resume, $application, $id);
            $this->appRepo->updateApplicationResume($application, $resume);
            return $application;
        } else {
            return null;
        }
    }
}
