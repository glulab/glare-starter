<?php

namespace Lit\Repositories;

use Logger;
use Ignite\Crud\CrudValidator;
use Ignite\Crud\Field;
use Ignite\Crud\Fields\Relations\LaravelRelationField;
use Ignite\Crud\Models\LitFormModel;
use Ignite\Crud\Requests\CrudCreateRequest;
use Ignite\Crud\Requests\CrudReadRequest;
use Ignite\Crud\Requests\CrudUpdateRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Ignite\Crud\Repositories\BaseFieldRepository;

class ZipImageRepository /* extends BaseFieldRepository */
{
    /**
     * Store new model.
     *
     * @param  CrudCreateRequest $request
     * @param  object            $payload
     * @param  Model             $model
     * @return CrudJs
     */
    public function store(Request $request, $payload, $model = null)
    {
        $fs = $request->files->all();
        foreach ($fs as $kF => $f) {
            if (strpos($kF, '_') === false) {
                continue;
            }
            $ex = explode('_', $kF);
            if ($ex[0] !== 'zip') {
                continue;
            }
            // $uploadedFile = $f;
            $collectionName = $ex[1];
        }
        
        Logger::logStart('Process Request File: ' . $kF, 'ZipImageRepository: ');
        
        // save zip file

        // file name 
        $fileBaseName = uniqid('zipimage-');
        
        $mainDirName = 'zipimage';
        $uploadDirName = "$mainDirName/upload";
        $extractDirName = "$mainDirName/extract";
        
        $fileExt = $request->$kF->extension();
        $fileName = $fileBaseName . '.' . $fileExt;
        
        $uploadFileDir = storage_path("app/$uploadDirName");
        if (!is_dir($uploadFileDir)) {
            Logger::log('Make upload directory: ' . $uploadFileDir, 'ZipImageRepository: ');
            mkdir($uploadFileDir, 0755, true);
        }
        $uploadedFile = $request->$kF->storeAs($uploadDirName, $fileName, 'local');
        
        $uploadedFilePath = storage_path("app/$uploadedFile");

        if (!is_file($uploadedFilePath)) {
            Logger::log('Error file upload: ' . $uploadedFilePath, 'ZipImageRepository: ');
            return false;
        }

        $extractDir = storage_path("app/$extractDirName/$fileBaseName");
        if (!is_dir($extractDir)) {
            Logger::log('Make extract directory: ' . $extractDir, 'ZipImageRepository: ');
            mkdir($extractDir, 0755, true);
        }

        $zip = new \ZipArchive;
        if ($zip->open($uploadedFilePath) === TRUE) {
            Logger::log('Extract file: ' . $uploadedFilePath, 'ZipImageRepository: ');
            $zip->extractTo($extractDir . '/');
            $zip->close();
            unlink($uploadedFilePath);
        } else {
            Logger::log('Error extracting file: ' . $uploadedFilePath, 'ZipImageRepository: ');
            return false;
        }

        $disk = \Storage::disk('local');
        $files = $disk->files("$extractDirName/$fileBaseName");

        foreach ($files as $keyFile => $file) {
            $filePath = storage_path("app/$file");
            if (!is_file($filePath)) {
                Logger::log('Invalid file: ' . $filePath, 'ZipImageRepository: ');
                continue;
            }
            
            Logger::log('Add file to media collection: ' . $filePath, 'ZipImageRepository: ');
            $model->addMedia($filePath)->toMediaCollection($collectionName);
        }
        
        Logger::log('Delete directory: ' . "$extractDirName/$fileBaseName", 'ZipImageRepository: ');
        $disk->deleteDirectory("$extractDirName/$fileBaseName");
        
        Logger::logEnd('End Processing Request File: ' . $kF, 'ZipImageRepository: ');
        return true;
    }
}
