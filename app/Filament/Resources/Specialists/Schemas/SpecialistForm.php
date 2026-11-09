<?php

namespace App\Filament\Resources\Specialists\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use App\Models\Speciality;

class SpecialistForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Специальности')
                        ->schema([
                            Select::make('specialities')
                                ->label('Выберите специальности')
                                ->relationship('specialities', 'name') // Указываем связь многие-ко-многим и поле для отображения
                                ->multiple() // Разрешаем выбирать несколько
                                ->searchable() // Поиск по списку
                                ->preload() // Предзагрузка списка
                                ->createOptionForm([ // Если специальности нет в базе, можно добавить новую в модалке
                                    TextInput::make('name')
                                        ->label('Название специальности')
                                        ->required(),
                                ])
                                ->columnSpanFull(),
                        ]),

                    Section::make('Основная информация')
                        ->schema([
                            TextInput::make('lastname')->label('Фамилия')->required(),
                            TextInput::make('name')->label('Имя')->required(),
                            TextInput::make('middle_name')->label('Отчество'),
                            FileUpload::make('image')->label('Фотография')->image()->directory('specialists')->required()->columnSpanFull(),
                            Textarea::make('description')->label('Описание')->required()->columnSpanFull(),
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
