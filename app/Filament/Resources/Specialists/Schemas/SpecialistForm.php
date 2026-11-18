<?php

namespace App\Filament\Resources\Specialists\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SpecialistForm
{
    public static function configure(Schema $schema): Schema
    {
        $updateSpecialistSlug = function (string $operation, Set $set, Get $get, ?Model $record, ?string $updatedField = null, ?string $updatedValue = null) {
            $lastname = $updatedField === 'lastname' ? $updatedValue : $get('lastname');
            $name = $updatedField === 'name' ? $updatedValue : $get('name');
            $middleName = $updatedField === 'middle_name' ? $updatedValue : $get('middle_name');
            $fullName = trim(implode(' ', array_filter([$lastname, $name, $middleName])));

            if ($operation === 'create') {
                $set('slug', Str::slug($fullName));
                return;
            }

            $currentSlug = $get('slug');
            $oldFullName = $record instanceof \App\Models\Specialist ? $record->full_name : trim(implode(' ', array_filter([$record?->lastname, $record?->name, $record?->middle_name])));
            if (blank($currentSlug) || $currentSlug === Str::slug((string) $oldFullName)) {
                $set('slug', Str::slug($fullName));
            }
        };

        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Специальности')
                        ->schema([
                            Select::make('specialities')
                                ->label('Выберите специальности')
                                ->relationship('specialities', 'name') 
                                ->multiple() 
                                ->searchable() 
                                ->preload() 
                                ->createOptionForm([ 
                                    TextInput::make('name')
                                        ->label('Название специальности')
                                        ->required(),
                                ])
                                ->columnSpanFull(),
                        ]),

                    Section::make('Основная информация')
                        ->schema([
                            TextInput::make('lastname')
                                ->label('Фамилия')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $operation, ?string $state, Set $set, Get $get, ?Model $record) => $updateSpecialistSlug($operation, $set, $get, $record, 'lastname', $state)),
                            TextInput::make('name')
                                ->label('Имя')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $operation, ?string $state, Set $set, Get $get, ?Model $record) => $updateSpecialistSlug($operation, $set, $get, $record, 'name', $state)),
                            TextInput::make('middle_name')
                                ->label('Отчество')
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (string $operation, ?string $state, Set $set, Get $get, ?Model $record) => $updateSpecialistSlug($operation, $set, $get, $record, 'middle_name', $state)),
                            TextInput::make('slug')
                                ->label('Slug (URL)')
                                ->required()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true)
                                ->columnSpanFull(),
                            FileUpload::make('image')->label('Фотография')->image()->disk('public')->directory('specialists')->required()->columnSpanFull(),
                            Textarea::make('description')->label('Описание')->required()->columnSpanFull(),
                            TextInput::make('keywords')->label('Ключевые слова (SEO)')->maxLength(255)->nullable()->columnSpanFull(),
                            TextInput::make('experience')->label('Опыт (лет)')->numeric()->required(),
                            TextInput::make('count_operations')->label('Количество операций')->numeric()->default(0),
                            TextInput::make('percentage_reviews')->label('Процент отзывов')->numeric()->default(100),
                        ])->columns(2),

                    Section::make('Направления деятельности')
                        ->schema([
                            Repeater::make('directions')
                                ->label('Направления')
                                ->relationship('directions')
                                ->schema([
                                    TextInput::make('name')->label('Название направления')->required(),
                                ])
                                ->addActionLabel('Добавить направление')
                        ]),

                    Section::make('Образование')
                        ->schema([
                            Repeater::make('educations')
                                ->label('Образование')
                                ->relationship('educations')
                                ->schema([
                                    TextInput::make('level')->label('Уровень образования')->required(),
                                    TextInput::make('organisation')->label('Организация')->required(),
                                    TextInput::make('year_issue')->label('Год выпуска')->numeric()->required(),
                                    TextInput::make('qualification')->label('Квалификация')->required(),
                                ])->columns(2)
                                ->addActionLabel('Добавить образование')
                        ]),

                    Section::make('Аккредитации и сертификаты')
                        ->schema([
                            Repeater::make('accreditations')
                                ->label('Аккредитации')
                                ->relationship('accreditations')
                                ->schema([
                                    TextInput::make('type_doc')->label('Тип документа')->required(),
                                    TextInput::make('speciality')->label('Специальность')->required(),
                                    TextInput::make('position')->label('Должность')->required(),
                                    DatePicker::make('date_issue')->label('Дата выдачи')->required(),
                                    DatePicker::make('validity_period')->label('Срок действия')->required(),
                                    TextInput::make('note')->label('Примечание')->nullable(),
                                ])->columns(2)
                                ->addActionLabel('Добавить аккредитацию')
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
