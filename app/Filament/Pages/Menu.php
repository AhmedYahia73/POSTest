<?php

namespace App\Filament\Pages;

use App\Models\Branch;
use Filament\Pages\Page;
use Filament\Schemas\Schema; // تأكد من استيراد Schema
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use BackedEnum;

class Menu extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.menu';

    protected static ?string $navigationLabel = 'Menue';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 2;

    public ?int $branch_id = null;

    public ?array $data = []; // أضف هذه المصفوفة لتخزين بيانات النموذج

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data') // ربط البيانات بمصفوفة data
            ->components([
                Select::make('branch_id')
                ->label('Select Branch')
                ->options(\App\Models\Branch::pluck('name', 'id'))
                ->live()
                ->afterStateUpdated(function ($state) {
                    $this->branch_id = $state;
                }),
            ]);
    }
}