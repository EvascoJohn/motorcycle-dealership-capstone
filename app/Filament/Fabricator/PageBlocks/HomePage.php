<?php

namespace App\Filament\Fabricator\PageBlocks;

use Filament\Forms\Components\Builder\Block;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;
use Filament\Forms;

class HomePage extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('home-page')
            ->schema([
                //HERO BLADE TITLE:     TEXT/Text input
                Forms\Components\TextInput::make('hero_title')
                        ->helperText(config('customer-website.home-page-block.hero_helper_text'))
                        ->label('Hero title'),
                //REGISTER BUTTON:      TEXT/Text input
                Forms\Components\TextInput::make('register_button')
                        ->helperText(config('customer-website.home-page-block.register_button_helper_text'))
                        ->label('Register button'),
                //EXPLORE               TEXT/Text input
                Forms\Components\TextInput::make('explore_button')
                        ->helperText(config('customer-website.home-page-block.explore_button_helper_text'))
                        ->label('Explore button'),
                //LATEST PRODUCTS TEXT  TEXT/Text input
                Forms\Components\TextInput::make('explore_button')
                        ->helperText(config('customer-website.home-page-block.latest_products_helper_text'))
                        ->label('Explore button'),
                //REQUREMENTS REPEATER  JSON/Repeater
                Forms\Components\Repeater::make('requirements')
                        ->label('Requirements'),
            ]);
    }

    public static function mutateData(array $data): array
    {
        return $data;
    }
}