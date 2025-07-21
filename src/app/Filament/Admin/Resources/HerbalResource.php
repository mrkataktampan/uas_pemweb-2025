<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HerbalResource\Pages;
use App\Filament\Admin\Resources\HerbalResource\RelationManagers\PenyakitsRelationManager;
use App\Models\Herbal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HerbalResource extends Resource
{
    protected static ?string $model = Herbal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Herbal')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->maxLength(1000)
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Herbal')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('penyakits.name')
                    ->label('Solusi Untuk')
                    ->limit(50),
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
            PenyakitsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHerbals::route('/'),
            'create' => Pages\CreateHerbal::route('/create'),
            'edit' => Pages\EditHerbal::route('/{record}/edit'),
        ];
    }

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'solusi_penyakit' => $this->penyakit->pluck('name'), // array nama penyakit
            'image_url' => $this->image_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}