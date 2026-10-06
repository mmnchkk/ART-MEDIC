<?php

namespace App\Filament\Resources\QuestionAnswers\Pages;

use App\Filament\Resources\QuestionAnswers\QuestionAnswerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuestionAnswers extends ListRecords
{
    protected static string $resource = QuestionAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
