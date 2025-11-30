<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RestauranteResource\Pages;
use App\Models\Restaurante;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;

class RestauranteResource extends Resource
{
    protected static ?string $model = Restaurante::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Restaurantes';

    protected static ?string $modelLabel = 'Restaurante';

    protected static ?string $pluralModelLabel = 'Restaurantes';

    protected static string|\UnitEnum|null $navigationGroup = 'Gestão';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informações do Restaurante')
                    ->schema([
                        TextInput::make('nome')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('cnpj')
                            ->label('CNPJ')
                            ->unique(ignoreRecord: true)
                            ->maxLength(18)
                            ->placeholder('00.000.000/0000-00')
                            ->helperText('Formato: 00.000.000/0000-00'),

                        TextInput::make('email')
                            ->label('E-mail')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('restaurante@exemplo.com'),

                        TextInput::make('telefone')
                            ->label('Telefone')
                            ->maxLength(20)
                            ->placeholder('(00) 00000-0000')
                            ->helperText('Formato: (00) 00000-0000'),

                        Textarea::make('endereco')
                            ->label('Endereço')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'ativo' => 'Ativo',
                                'inativo' => 'Inativo',
                                'suspenso' => 'Suspenso',
                            ])
                            ->default('ativo')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->label('Nome')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('cnpj')
                    ->label('CNPJ')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        if (!$state) return '-';
                        // Remove formatação existente
                        $cnpj = preg_replace('/\D/', '', $state);
                        // Aplica formatação se tiver 14 dígitos
                        if (strlen($cnpj) === 14) {
                            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
                        }
                        return $state;
                    })
                    ->toggleable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-envelope')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('telefone')
                    ->label('Telefone')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'ativo' => 'success',
                        'inativo' => 'gray',
                        'suspenso' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'ativo' => 'Ativo',
                        'inativo' => 'Inativo',
                        'suspenso' => 'Suspenso',
                        default => $state,
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'ativo' => 'Ativo',
                        'inativo' => 'Inativo',
                        'suspenso' => 'Suspenso',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('nome');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRestaurantes::route('/'),
            'create' => Pages\CreateRestaurante::route('/create'),
            'edit' => Pages\EditRestaurante::route('/{record}/edit'),
        ];
    }
}

