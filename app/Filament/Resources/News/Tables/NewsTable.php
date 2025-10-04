<?php

namespace App\Filament\Resources\News\Tables;

use App\Models\News;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image_path')
                    ->label('Gambar Utama')
                    ->disk('public')
                    ->width(80),
                TextColumn::make('title')->label('Title')->searchable()->sortable(),
                TextColumn::make('category.name')->label('Category')->searchable()->sortable(),
                TextColumn::make('status')->label('Status')->searchable()->sortable(),
                IconColumn::make('is_featured')->label('Featured')->boolean()->sortable(),
                TextColumn::make('published_at')->label('Published At')->dateTime()->sortable(),
                TextColumn::make('author.name')->label('Author')->searchable()->sortable(),
                TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('delete')
                    ->requiresConfirmation()
                    ->action(fn (News $record) => $record->delete())
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
