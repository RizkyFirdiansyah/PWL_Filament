<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Laravel\Pail\File;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([

                Section::make('Post Details')
                    ->description('Fill in the details of the post.')
                    ->icon('heroicon-s-document-text')
                    ->schema([
                        Group::make([
                            TextInput::make('title')
                                ->required()
                                ->minLength(5),

                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true),

                            Select::make('category_id')
                                ->relationship('category', 'name')
                                ->preload()
                                ->searchable(),

                            ColorPicker::make('color'),
                        ])->columns(2),

                        MarkdownEditor::make('content'),
                    ])
                    ->columnSpan(2),

                Group::make([
                    Section::make('Image Upload')
                        ->icon('heroicon-s-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('posts'),
                        ]),

                    Section::make('Meta Information')
                        ->icon('heroicon-s-information-circle')
                        ->schema([
                            TagsInput::make('tags'),

                            Checkbox::make('published'),

                            DateTimePicker::make('published_at'),
                        ]),
                ])
                    ->columnSpan(1),

            ]);
    }
}
