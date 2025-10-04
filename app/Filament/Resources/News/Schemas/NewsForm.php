<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Berita')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan judul berita...'),
                
                TextInput::make('excerpt')
                    ->label('Ringkasan')
                    ->required()
                    ->maxLength(500),

                RichEditor::make('content')
                    ->label('Konten Berita')
                    ->required(),

                FileUpload::make('featured_image_path')
                    ->label('Gambar Utama')
                    ->image()
                    ->disk('public')
                    ->directory('news/featured')
                    ->visibility('public')
                    ->maxSize(10240),

                Select::make('news_category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable(),

                // user_id is set automatically to the currently authenticated user on create

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                        'deleted' => 'Deleted',
                    ])
                    ->default('draft'),

                DateTimePicker::make('published_at')
                    ->label('Tanggal Terbit'),

                Toggle::make('is_featured')
                    ->label('Featured'),
            ]);
    }
}
