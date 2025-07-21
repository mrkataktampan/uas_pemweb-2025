<?php

namespace App\Filament\Admin\Resources\HerbalResource\RelationManagers;

use App\Models\Penyakit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;

class PenyakitsRelationManager extends RelationManager
{
    protected static string $relationship = 'penyakits';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('penyakit_id')
                ->label('Pilih Penyakit')
                ->relationship('penyakits', 'name') // tidak cocok: karena bukan relasi langsung
                ->options(Penyakit::pluck('name', 'id')) // pake cara ini
                ->searchable()
                ->required(),

            Forms\Components\Textarea::make('notes')
                ->label('Catatan')
                ->nullable()
                ->rows(3),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Penyakit'),
                Tables\Columns\TextColumn::make('pivot.notes')->label('Catatan'),
            ])
            ->headerActions([
                CreateAction::make()
                ->label('Hubungkan Penyakit')
                ->form([
                    Forms\Components\Select::make('penyakit_id')
                        ->label('Penyakit')
                        ->options(Penyakit::pluck('name', 'id'))
                        ->searchable()
                        ->required(),

                    Forms\Components\Textarea::make('notes')
                        ->label('Catatan')
                        ->nullable()
                        ->rows(3),
                ])
                ->action(function (array $data) {
                    $this->ownerRecord->penyakits()->attach($data['penyakit_id'], [
                        'notes' => $data['notes'] ?? null,
                    ]);
                }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->action(function ($record, $livewire) {
                        // detach penyakit dari herbal
                        $livewire->ownerRecord->penyakits()->detach($record->id);
                    }),
            ]);
    }
}