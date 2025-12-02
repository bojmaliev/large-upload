<?php

namespace App\Filament\Resources\Uploads\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class UploadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('source')
                    ->label('Upload File')
                    ->moveFiles()
                    ->required(),
            ]);
    }
}
