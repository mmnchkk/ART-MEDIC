<?php

namespace App\Filament\Resources\QuestionAnswers\Schemas;

use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuestionAnswerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Часто задаваемый вопрос')
                            ->description('Укажите вопрос и подробный развернутый ответ на него')
                            ->icon('heroicon-o-question-mark-circle')
                            ->schema([
                                TextInput::make('question')
                                    ->label('Вопрос')
                                    ->placeholder('Например: Как записаться на прием к специалисту?')
                                    ->required()
                                    ->maxLength(255),

                                Textarea::make('answer')
                                    ->label('Ответ')
                                    ->placeholder('Подробный ответ на вопрос...')
                                    ->rows(4)
                                    ->required(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}