<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Carbon\Carbon;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;


class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    const ORIGIN = [
        'waitlist' => 'Fila de espera',
        'reservation' => 'Reservas',
        'review' => 'Avaliações',
        'vip' => 'Clube VIP',
        'loyalty' => 'Fidelidade'
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('30s')
            ->columns([
                
                IconColumn::make('mobile')
                    ->label('')
                    ->trueIcon('heroicon-o-chat')
                    ->color('success')
                    ->action(
                        Action::make('sendMessage')
                            ->label('Enviar mensagem')
                            ->action(function (Contact $record,$livewire): void {

                                $record->update([
                                    'last_message_sent_at' => now(),
                                ]);

                                $livewire->dispatchBrowserEvent('send-whatsapp-message', [
                                    'phone' => Str::onlyNumbers($record->mobile),
                                    'message' => urlencode('Sample message'),
                                ]);
                            })
                            ->form([
                                Select::make('quick_answer_id')
                                    ->label('Mensagem')
                                    ->options([])
                                    ->required()
                                    ->searchable()
                            ])
                    ),


                TextColumn::make('name')
                    ->label('Nome do contato')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('date_of_birth')
                    ->label('Nascimento')
                    ->date('d/m/Y')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('birthday')
                    ->label('Aniversário')
                    ->date('d/m/Y')
                    ->toggleable(),

                TextColumn::make('city.name')
                    ->label('Cidade')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('city.state.letter')
                    ->label('Estado')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('city.state.region.name')
                    ->label('Região')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('gender')
                    ->label('Gênero')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->enum([
                        'm' => 'Masculino',
                        'f' => 'Feminino',
                    ]),

                IconColumn::make('is_vip')
                    ->label('Clube VIP')
                    ->toggleable()
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->toggleable(),

                IconColumn::make('send_notifications')
                    ->label('Notificações')
                    ->toggleable()
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->toggleable(),

                TextColumn::make('last_message_sent_at')
                    ->label('Última mensagem')
                    ->sortable(true)
                    ->since()
                    ->toggleable()
                    ->color(static function (Contact $record): string {

                        if ($record->last_message_sent_at && $record->last_message_sent_at->addDay(1) <= Carbon::now()) {
                            return 'default';
                        }

                        return 'success';
                    }),

                TextColumn::make('origin')
                    ->label('Origem')
                    ->toggleable()
                    ->enum(self::ORIGIN),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->sortable(true)
                    ->since()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }    
}
