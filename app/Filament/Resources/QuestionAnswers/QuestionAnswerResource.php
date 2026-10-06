<?php

namespace App\Filament\Resources\QuestionAnswers;

use App\Filament\Resources\QuestionAnswers\Pages\CreateQuestionAnswer;
use App\Filament\Resources\QuestionAnswers\Pages\EditQuestionAnswer;
use App\Filament\Resources\QuestionAnswers\Pages\ListQuestionAnswers;
use App\Filament\Resources\QuestionAnswers\Schemas\QuestionAnswerForm;
use App\Filament\Resources\QuestionAnswers\Tables\QuestionAnswersTable;
use App\Models\QuestionAnswer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QuestionAnswerResource extends Resource
{
    protected static ?string $model = QuestionAnswer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedQuestionMarkCircle;

    protected static ?string $navigationLabel = 'Вопросы и ответы';
    protected static ?string $modelLabel = 'Вопрос и ответ';
    protected static ?string $pluralModelLabel = 'Вопросы и ответы';

    public static function form(Schema $schema): Schema
    {
        return QuestionAnswerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuestionAnswersTable::configure($table);
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
            'index' => ListQuestionAnswers::route('/'),
            'create' => CreateQuestionAnswer::route('/create'),
            'edit' => EditQuestionAnswer::route('/{record}/edit'),
        ];
    }
}