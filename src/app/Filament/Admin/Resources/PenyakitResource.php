<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PenyakitResource\Pages;
use App\Models\Penyakit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PenyakitResource extends Resource
{
    protected static ?string $model = Penyakit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Penyakit';
    protected static ?string $pluralModelLabel = 'Penyakit';
    protected static ?string $slug = 'penyakit';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Penyakit')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('symptoms')
                    ->label('Gejala')
                    ->maxLength(1000)
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Penyakit')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('symptoms')
                    ->label('Gejala')
                    ->limit(50)
                    ->wrap(),

                // Optional: tampilkan herbal yang terkait
                Tables\Columns\TextColumn::make('herbals.name')
                    ->label('Solusi Herbal')
                    ->badge()
                    ->separator(', '),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // relasi ke Herbal jika pakai RelationManager nanti
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenyakits::route('/'),
            'create' => Pages\CreatePenyakit::route('/create'),
            'edit' => Pages\EditPenyakit::route('/{record}/edit'),
        ];
    }
}