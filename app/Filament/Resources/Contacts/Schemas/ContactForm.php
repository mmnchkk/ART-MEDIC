<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Основная информация и адрес')
                            ->description('Укажите физический адрес, данные для SMS и график работы')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                TextInput::make('adress')
                                    ->label('Адрес')
                                    ->placeholder('г. Москва, ул. Ленина, д. 10')
                                    ->required()
                                    ->columnSpanFull(),

                                TextInput::make('schedule')
                                    ->label('Расписание')
                                    ->placeholder('Пн-Пт: 9:00 - 20:00, Сб-Вс: 10:00 - 18:00')
                                    ->required(),

                                TextInput::make('sms')
                                    ->label('SMS / Информирование')
                                    ->placeholder('+7 (999) 000-00-00')
                                    ->required(),
                            ])
                            ->columns(2),

                        Section::make('Телефоны')
                            ->description('Список контактных номеров клиники')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Repeater::make('phones')
                                    ->label('Телефоны')
                                    ->relationship('phones')
                                    ->schema([
                                        TextInput::make('phone')
                                            ->label('Телефон')
                                            ->placeholder('+7 (495) 000-00-00')
                                            ->tel()
                                            ->required(),

                                        TextInput::make('description')
                                            ->label('Описание / Отдел')
                                            ->placeholder('Регистратура, Горячая линия...')
                                            ->required(),
                                    ])
                                    ->columns(2)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => 
                                        isset($state['phone']) 
                                            ? "{$state['phone']}" . (isset($state['description']) ? " ({$state['description']})" : '') 
                                            : null
                                    )
                                    ->addActionLabel('Добавить телефон')
                                    ->defaultItems(1),
                            ]),

                        Section::make('Электронная почта')
                            ->description('Адреса e-mail для обращений и партнеров')
                            ->icon('heroicon-o-envelope')
                            ->schema([
                                Repeater::make('mails')
                                    ->label('Почты')
                                    ->relationship('mails')
                                    ->schema([
                                        TextInput::make('mail')
                                            ->label('Почта')
                                            ->placeholder('info@clinic.ru')
                                            ->email()
                                            ->required(),

                                        TextInput::make('description')
                                            ->label('Описание / Отдел')
                                            ->placeholder('Общие вопросы, Бухгалтерия...')
                                            ->required(),
                                    ])
                                    ->columns(2)
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => 
                                        isset($state['mail']) 
                                            ? "{$state['mail']}" . (isset($state['description']) ? " ({$state['description']})" : '') 
                                            : null
                                    )
                                    ->addActionLabel('Добавить почту')
                                    ->defaultItems(1),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}