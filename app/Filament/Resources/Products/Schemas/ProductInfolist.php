<?php

namespace App\Filament\Resources\Products\Schemas;

use BladeUI\Icons\Components\Icon;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Image;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs\Tab;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Product Tabs')
                    ->tabs([
                        Tab::make('Product Info')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Product Name')
                                    ->weight('bold')
                                    ->color('primary'),
                                TextEntry::make('id')
                                    ->label('Product ID'),
                                TextEntry::make('sku')
                                    ->label('Product SKU')
                                    ->badge()
                                    ->color('warning'),
                                TextEntry::make('description')
                                    ->label('Product Description'),
                                TextEntry::make('created_at')
                                    ->label('Product Created Date')
                                    ->date('d M Y')
                                    ->color('info'),
                            ]),
                        Tab::make('Product Pricing & Stock')
                            ->icon('heroicon-o-banknotes')
                            ->schema([
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->icon('heroicon-o-archive-box')
                                    ->badge()
                                    ->color(fn($state) => match (true) {
                                        $state <= 0 => 'danger',   // stok habis
                                        $state <= 10 => 'warning', // stok sedikit
                                        default => 'success',      // stok aman
                                    }),
                            ]),
                        Tab::make('Image & Status')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('image')
                                    ->label('Product Image')
                                    ->disk('public'),
                                TextEntry::make('price')
                                    ->label('Product Price')
                                    ->weight('bold')
                                    ->color('primary')
                                    ->icon('heroicon-o-currency-dollar'),
                                TextEntry::make('stock')
                                    ->label('Product Stock')
                                    ->weight('bold')
                                    ->badge()
                                    ->color(fn($state) => match (true) {
                                        $state <= 0 => 'danger',
                                        $state <= 10 => 'warning',
                                        default => 'success',
                                    }),
                                IconEntry::make('is_active')
                                    ->label('Is Active?')
                                    ->boolean(),
                                IconEntry::make('is_featured')
                                    ->label('Is Featured?')
                                    ->boolean()
                            ]),
                    ])
                    ->columnSpanFull()
                    ->vertical(),

                // Section::make('Product Info')
                //     ->schema([
                //         TextEntry::make('name')
                //             ->label('Product Name')
                //             ->weight('bold')
                //             ->color('primary'),
                //         TextEntry::make('id')
                //             ->label('Product ID'),
                //         TextEntry::make('sku')
                //             ->label('Product SKU')
                //             ->badge()
                //             ->color('warning'),
                //         TextEntry::make('description')
                //             ->label('Product Description'),
                //         TextEntry::make('created_at')
                //             ->label('Product Created Date')
                //             ->date('d M Y')
                //             ->color('info'),
                //     ])
                //     ->columnSpanFull(),
                // Section::make('Pricing & Stock')
                //     ->schema([
                //         TextEntry::make('price')
                //             ->label('Product Price')
                //             ->icon('heroicon-o-currency-dollar')
                //             ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                //         TextEntry::make('stock')
                //             ->label('Product Stock')
                //             ->icon('heroicon-o-archive-box'),
                //     ])
                //     ->columnSpanFull(),
                // Section::make('Image & Status')
                //     ->description('')
                //     ->schema([
                //         ImageEntry::make('image')
                //             ->label('Product Image')
                //             ->disk('public'),
                //         TextEntry::make('price')
                //             ->label('Product Price')
                //             ->weight('bold')
                //             ->color('primary')
                //             ->icon('heroicon-o-currency-dollar'),
                //         TextEntry::make('stock')
                //             ->label('Product Stock')
                //             ->weight('bold')
                //             ->color('primary'),
                //         IconEntry::make('is_active')
                //             ->label('Is Active?')
                //             ->boolean(),
                //         IconEntry::make('is_featured')
                //             ->label('Is Featured?')
                //             ->boolean()
                //     ])
                //     ->columnSpanFull(),
            ]);
    }
}
