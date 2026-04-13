<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Schemas\Schema;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group as ComponentsGroup;
use Filament\Schemas\Components\Wizard as ComponentsWizard;
use Filament\Schemas\Components\Wizard\Step as WizardStep;
use Filament\Tables\Grouping\Group;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;


class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsWizard::make([
                    WizardStep::make('Product Info')
                        ->icon('heroicon-s-document-text')
                        ->description('Isi Informasi Produk')
                        ->schema([
                            ComponentsGroup::make([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('sku')
                                    ->numeric()
                                    ->required()
                            ])->columns(2),
                            MarkdownEditor::make('description')
                                ->required(),
                        ]),
                    WizardStep::make('Pricing & Stock')
                        ->icon('heroicon-s-currency-dollar')
                        ->description('Isi Harga produk')
                        ->schema([
                            ComponentsGroup::make([
                                TextInput::make('price')
                                    ->minValue(1)
                                    ->required()
                                    ->numeric(),
                                TextInput::make('stock')
                                    ->required()
                                    ->numeric(),
                            ])->columns(2),

                            MarkdownEditor::make('description')
                                ->columnSpanFull(),
                        ]),
                    WizardStep::make('Media & Status')
                        ->icon('heroicon-s-photo')
                        ->description('Upload gambar dan atur status')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('products'),
                            Checkbox::make('is_active'),
                            Checkbox::make('is_featured'),
                        ]),
                ])
                    ->ColumnSpanFull()
                    ->submitAction(
                        Action::make('save')
                            ->label('Save Product')
                            ->color('primary')
                            ->submit('save')
                    )
            ]);
    }
}
