<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class MyProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.my-profile';
    
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();
        $this->form->fill([
            'avatar_url' => $user->avatar_url,
            'name' => $user->name,
            'email' => $user->email,
            'no_hp' => $user->no_hp,
        ]);
    }

    public function getTitle(): string
    {
        return Auth::user()->role === 'admin'
            ? 'Profil Admin'
            : 'Profil User';
    }

    protected function getFormSchema(): array
    {
        return [
            FileUpload::make('avatar_url')
                ->label('Avatar')
                ->disk('public')
                ->directory('avatars')
                ->image()
                ->imageEditor(),

            TextInput::make('name')
                ->label('Nama')
                ->required(),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),

            TextInput::make('no_hp')
                ->label('No HP'),
        ];
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        
        $user = Auth::user();
        $user->update(
            array_filter($data, function($value) {
                return $value !== null;
            })
        );

        Notification::make()
            ->success()
            ->title('Profil berhasil diperbarui')
            ->send();
    }

    protected function getFormStatePath(): ?string
    {
        return 'data';
    }
}