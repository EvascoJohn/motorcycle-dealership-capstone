<?php

namespace App\Filament\Fabricator\PageBlocks;

use Filament\Forms\Components\Builder\Block;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;
use Filament\Forms;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class HomePage extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('home-page')
            ->schema([
                //HERO BLADE TITLE:     TEXT/Text input
                Forms\Components\TextInput::make('hero_title')
                        ->label('Hero title')
                        ->helperText(config('customer-website.home-page-block.hero_helper_text')),
                //HOME PAGE HERO IMAGE IMAGE
                Forms\Components\FileUpload::make("heading_image")
                        ->required()
                        ->label("Heading Image")
                        ->disk('local')
                        ->directory('public/site-images')
                        ->visibility('private')
                        ->acceptedFileTypes(['image/jpeg'])
                        ->getUploadedFileNameForStorageUsing(
                            fn (Forms\Get $get, TemporaryUploadedFile $file): string => (string) "homepage-hero-image.jpg"
                        ),
                //REGISTER BUTTON:      TEXT/Text input
                Forms\Components\TextInput::make('register_button')
                        ->label('Register button')
                        ->helperText(config('customer-website.home-page-block.register_button_helper_text')),
                //EXPLORE               TEXT/Text input
                Forms\Components\TextInput::make('explore_button')
                        ->label('Explore button')
                        ->helperText(config('customer-website.home-page-block.explore_button_helper_text')),
                //LATEST PRODUCTS TEXT  TEXT/Text input
                Forms\Components\TextInput::make('latest_products')
                        ->helperText(config('customer-website.home-page-block.latest_products_helper_text'))
                        ->label('Latest Products'),
                //REQUREMENTS REPEATER  JSON/Repeater
                Forms\Components\Repeater::make('requirements')


            ]);
    }

    public static function mutateData(array $data): array
    {
        dd($data);
        return $data;
    }
}