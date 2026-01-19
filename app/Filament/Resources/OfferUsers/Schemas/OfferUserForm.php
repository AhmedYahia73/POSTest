<?php

namespace App\Filament\Resources\OfferUsers\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class OfferUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->components([
            Section::make('Offer Data')
            ->description('Offer Info.')
            ->schema([ 
                TextInput::make('name')
                ->label("Offer Title")
                ->required() 
                ->placeholder('Enter Offer'), 
                Select::make('branch_id')
                ->label('branch')
                ->required()
                ->preload()
                ->relationship(name: 'branch', titleAttribute: 'name')
                ->placeholder('Select a Branch'),
                TextInput::make('user')
                ->label("User")
                ->required() 
                ->placeholder('Enter User'), 
                Textarea::make('desciption')
                ->label("Desciption") 
                ->placeholder('Enter Desciption'), 
                DatePicker::make('date')
                ->label('Offer Date')
                ->required(),  
                Select::make('status')
                ->label('Status')
                ->required()
                ->options([
                    'pending' => 'pending',
                    'accepted' => 'accepted',
                    'rejected' => 'rejected',
                ])
                ->placeholder('Select a Status'),
                TextInput::make('total')
                ->label("Total")
                ->numeric()
                ->required()
                ->readOnly() // يبقى للقراءة فقط لأنه ناتج حسابي
                ->placeholder('0.00'),
            ]),
            Section::make('Products Section')
            ->description('Add your products and prices here.')
            ->schema([ 
                Repeater::make('Products')
                ->relationship(
                        name: 'products',  
                    )
                    ->label('Products')
                    ->schema([
                        Select::make('product_id')
                        ->label('Products')
                        ->required()
                        ->preload()
                        ->relationship(name: 'products', titleAttribute: 'name')
                        ->placeholder('Select a Product'),

                        TextInput::make('price')
                        ->label('Price')
                        ->default(0)
                        ->numeric()
                        ->required()
                        // 1. نجعل الحقل يتفاعل فوراً عند تغيير السعر
                        ->live(onBlur: true) 
                        // 2. نقوم بتحديث حقل الـ Total عند تغيير السعر
                        ->afterStateUpdated(function (Get $get, Set $set) {
                            self::updateTotal($get, $set);
                        }),
                        TextInput::make('quantity')
                        ->label('Quantity')
                        ->default(0)
                        ->numeric()
                        ->required(),
                    ])
                    ->columns(3)
                    ->createItemButtonLabel('Add Product')
                    // 3. نقوم بتحديث الإجمالي أيضاً عند حذف عنصر من القائمة
                    ->afterStateUpdated(function (Get $get, Set $set) {
                    self::updateTotal($get, $set);
                }),
            ]),
        ]);
    }

    public static function updateTotal(Get $get, Set $set): void
    {
        // الحصول على جميع مدخلات الـ repeater
        $selectedProducts = $get('Products');

        if (empty($selectedProducts)) {
            $set('total', 0);
            return;
        }

        // جمع كافة الأسعار (تحويلها لـ float لضمان دقة الحساب)
        $total = collect($selectedProducts)
            ->map(fn ($item) => (float) ($item['price'] ?? 0))
            ->sum();

        // تحديث قيمة حقل الـ total
        $set('total', number_format($total, 2, '.', ''));
    }
}
